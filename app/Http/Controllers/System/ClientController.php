<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use Exception;
use Hyn\Tenancy\Contracts\Repositories\HostnameRepository;
use Hyn\Tenancy\Contracts\Repositories\WebsiteRepository;
use App\Http\Resources\System\ClientCollection;
use App\Http\Requests\System\ClientRequest;
use App\Http\Requests\System\ResetPasswordMassiveRequest;
use App\Http\Resources\System\ClientResource;
use Hyn\Tenancy\Environment;
use App\Models\System\Client;
use App\Models\System\PaymentHistory;
use App\Models\System\Plan;
use App\Models\System\Status;
use App\Models\Tenant\Country;
use App\Models\Tenant\Department;
use App\Models\Tenant\District;
use App\Models\Tenant\IdentityDocumentType;
use App\Models\Tenant\Person;
use App\Models\Tenant\Province;
use Hyn\Tenancy\Models\Hostname;
use Hyn\Tenancy\Models\Website;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str;

class ClientController extends Controller
{
    public function index()
    {
        return Inertia::render('System/Clients/Index');
    }

    public function tables()
    {
        $url_base = '.' . config('app.app_url_base');
        $plans = Plan::all();
        $clients_all = Client::get()->count();
        $clients_active = Client::where('status_id', Status::INACTIVE)->get()->count();

        return compact('url_base', 'plans', 'clients_all', 'clients_active');
    }

    public function record($id)
    {
        $record = new ClientResource(Client::findOrFail($id));

        return $record;
    }

    public function records(Request $request)
    {
        $status_id = intval($request->input('status_id'));
        if ($status_id == 0) {
            $records = Client::get();
        } else {
            $active_value = $status_id == 1 ? true : false;
            $records = Client::where('status_id', $active_value)->get();
        }
        foreach ($records as &$row) {
            $tenancy = app(Environment::class);
            $tenancy->tenant($row->hostname->website);
            $row->count_doc = DB::connection('tenant')->table('documents')->count();
            $row->count_user = DB::connection('tenant')->table('users')->count();
        }
        return new ClientCollection($records);
    }

    public function charts()
    {
        $records = PaymentHistory::select(
            DB::raw('MONTH(date_payment) AS month'),
            DB::raw('SUM(amount) as total')
        )
            ->whereYear('date_payment', now()->year)
            ->groupBy(DB::raw('MONTH(date_payment)'))
            ->get();
        $documents_by_month = [];

        for ($i = 1; $i <= 12; $i++) {
            $total = 0;
            foreach ($records as $row) {
                if ($row->month == $i) {
                    $total = $row->total;
                    break;
                }
            }
            $documents_by_month[] = $total;
            // [
            //     'month' => $i,
            //     'total' => $total
            // ];
        }
        //dd($records);

        $total_documents = 0; //collect($count_documents)->sum('count');

        //$groups_by_month = collect($count_documents)->groupBy('month');
        $labels = ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Set', 'Oct', 'Nov', 'Dic'];
        // $documents_by_month = [];
        // foreach ($groups_by_month as $month => $group) {
        //     //            $labels[] = $month;
        //     $documents_by_month[] = $group->sum('count');
        // }

        $line = [
            'labels' => $labels,
            'data' => $documents_by_month
        ];
        $year = date('Y');
        $total_payments = PaymentHistory::select(DB::raw('SUM(amount) as total'))->first();
        $total_payments = $total_payments ? $total_payments->total : 0;
        $total_payments = $total_payments ?? 0;
        return compact('line', 'total_documents', 'total_payments', 'year');
    }

    public function store(ClientRequest $request)
    {
        $id = $request->input('id');
        if ($id == null) {

            $subDom = strtolower($request->input('subdomain'));
            $uuid = config('app.prefix_database') . '_' . $subDom;
            $fqdn = $subDom . '.' . config('app.app_url_base');

            $website = new Website();
            $hostname = new Hostname();



            try {
                DB::beginTransaction();
                $website->uuid = $uuid;
                app(WebsiteRepository::class)->create($website);
                $hostname->fqdn = $fqdn;
                app(HostnameRepository::class)->attach($hostname, $website);

                $token = Str::random(50);

                $client = new Client();
                $client->hostname_id = $hostname->id;
                $client->token = $token;
                $client->email = strtolower($request->input('email'));
                $client->name = $request->input('name');
                $client->number = $request->input('number');
                $client->plan_id = $request->input('plan_id');
                $client->plan_start_date = $request->input('plan_start_date');
                $client->amount = $request->input('amount');
                $client->status_id = true;
                $client->save();

                $tenancy = app(Environment::class);
                $tenancy->tenant($website);

                DB::commit();
            } catch (Exception $e) {
                DB::rollBack();
                app(HostnameRepository::class)->delete($hostname, true);
                app(WebsiteRepository::class)->delete($website, true);

                return [
                    'success' => false,
                    'message' => $e->getMessage()
                ];
            }

            DB::connection('tenant')->table('companies')->insert([
                'identity_document_type_id' => '6',
                'number' => $request->input('number'),
                'name' => $request->input('name'),
                'trade_name' => $request->input('name'),
                'soap_type_id' => '01'
            ]);

            DB::connection('tenant')->table('configurations')->insert([
                'send_auto' => true,
            ]);
            $country = Country::where('short', 'PE')->first();
            $departament = Department::where('description', 'LIMA')->first();
            $province  = Province::where('description', 'LIMA')->first();
            $district  = District::where('description', 'LIMA')->first();
            $establishment_id = DB::connection('tenant')->table('establishments')->insertGetId([
                'description' => 'Oficina Principal',
                'country_id' => $country->id,
                'department_id' => $departament->id,
                'province_id' => $province->id,
                'district_id' => $district->id,
                'address' => '-',
                'email' => $request->input('email'),
                'telephone' => '-',
                'code' => '0000'
            ]);

            DB::connection('tenant')->table('warehouses')->insertGetId([
                'establishment_id' => $establishment_id,
                'description' => 'Almacén - ' . 'Oficina Principal',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

            DB::connection('tenant')->table('series')->insert([
                ['establishment_id' => 1, 'document_type_id' => 1, 'number' => 'F001'],
                ['establishment_id' => 1, 'document_type_id' => 3, 'number' => 'B001'],
                ['establishment_id' => 1, 'document_type_id' => 4, 'number' => 'FC01'],
                ['establishment_id' => 1, 'document_type_id' => 4, 'number' => 'BC01'],
                ['establishment_id' => 1, 'document_type_id' => 5, 'number' => 'FD01'],
                ['establishment_id' => 1, 'document_type_id' => 5, 'number' => 'BD01'],
                ['establishment_id' => 1, 'document_type_id' => 7, 'number' => 'R001'],
                ['establishment_id' => 1, 'document_type_id' => 6, 'number' => 'T001'],
                ['establishment_id' => 1, 'document_type_id' => 12, 'number' => 'NV01'],
                ['establishment_id' => 1, 'document_type_id' => 16, 'number' => 'AN01'],
            ]);
            $document_number = '00000000';
            $person = Person::create([
                'identity_document_type_id' => IdentityDocumentType::DNI,
                'number' => $document_number,
                'name' => 'DISOFT SOLUCIONES INTEGRALES S.A.C.',
                'trade_name' => '-',
                'country_id' => $country->id,
                'department_id' => $departament->id,
                'province_id' => $province->id,
                'district_id' => $district->id,
                'address' => 'AV. SANTIAGO ANTUNEZ DE MAYOLO NRO. 1047 INT. 201 URB.  MERCURIO',
                'email' => 'consulta@disoft.pe',
                'telephone' => 991992688,
                'status_id' => Status::ACTIVE 
            ]);

            DB::connection('tenant')->table('users')->insert([
                'username' => '00000000',
                'password' => bcrypt($request->input('password')),
                'remember_token' => $token,
                'person_id' => $person->id
            ]);

            

            // DB::connection('tenant')->table('module_user')->insert([
            //     'module_id' => 7,
            //     'user_id' => 1
            // ]);

            // DB::connection('tenant')->table('module_user')->insert([
            //     'module_id' => 10,
            //     'user_id' => 1
            // ]);


            DB::connection('tenant')->table('inventory_configurations')->insert([
                ['stock_control' => 0],
            ]);

            DB::connection('tenant')->table('supplies_uncountables')->insert([
                ['description' => 'Mayonesa'],
                ['description' => 'Mostaza'],
                ['description' => 'Ketchup'],
                ['description' => 'Ají'],
                ['description' => 'Tomate']
            ]);

            return [
                'success' => true,
                'message' => 'Cliente Registrado satisfactoriamente'
            ];
        } else {

            $client = Client::findOrFail($id);
            if ($client) {
                $client->plan_id = $request->input('plan_id');
                $client->plan_start_date = $request->input('plan_start_date');
                $client->amount = $request->input('amount');
                $client->save();

                if ($request->input('password')) {

                    $website = Website::find($client->hostname->website_id);
                    $tenancy = app(Environment::class);
                    $tenancy->tenant($website);
                    DB::connection('tenant')->table('users')
                        ->where('id', 1)
                        ->update(['password' => bcrypt($request->input('password'))]);
                }
            }

            return [
                'success' => true,
                'message' => 'Cliente Actualizado satisfactoriamente'
            ];
        }
    }

    public function destroy($id)
    {
        $client = Client::find($id);
        $paymentHistory = PaymentHistory::where('client_id', $id)->first();
        $hostname = Hostname::find($client->hostname_id);
        $website = Website::find($hostname->website_id);

        if ($paymentHistory) $paymentHistory->delete();
        app(HostnameRepository::class)->delete($hostname, true);
        app(WebsiteRepository::class)->delete($website, true);

        return [
            'success' => true,
            'message' => 'Cliente eliminado con éxito'
        ];
    }

    public function status_id(Request $request)
    {
        $id = $request->input('id');
        $client = Client::find($id);

        if ($client) {
            $client->status_id = $request->input('status_id');
            $client->save();
        }
        return [
            'success' => true,
            'message' => 'Cliente actualizado con éxito'
        ];
    }

    public function password($id)
    {
        $client = Client::find($id);
        $website = Website::find($client->hostname->website_id);
        $tenancy = app(Environment::class);
        $tenancy->tenant($website);
        DB::connection('tenant')->table('users')
            ->where('id', 1)
            ->update(['password' => bcrypt($client->number)]);

        return [
            'success' => true,
            'message' => 'Clave cambiada con éxito'
        ];
    }

    public function reset_password_massive(ResetPasswordMassiveRequest $request)
    {
        $response = ['success' => false];
        try {
            $clients = Client::all();
            foreach ($clients as $client) {
                $website = Website::find($client->hostname->website_id);
                $tenancy = app(Environment::class);
                $tenancy->tenant($website);
                DB::connection('tenant')->beginTransaction();
                DB::connection('tenant')->table('users')
                    ->where('id', 1)
                    ->update(['password' => bcrypt($request->password)]);
                DB::connection('tenant')->commit();
            }
            $response['success'] = true;
            $response['message'] = "Se cambio statisfactoriamente las contraseñas de los Clientes.";
            return response()->json($response);
        } catch (Exception $e) {
            DB::connection('tenant')->rollBack();
            $response['message'] = $e->getMessage();
            return response()->json($response);
        }
    }
}
