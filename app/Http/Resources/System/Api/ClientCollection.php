<?php

namespace App\Http\Resources\System\Api;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Hyn\Tenancy\Environment;
use Illuminate\Support\Facades\DB;

class ClientCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function toArray($request)
    {
        return $this->collection->transform(function($row, $key) {

            $tenancy = app(Environment::class);
            $tenancy->tenant($row->hostname->website);

            $company = DB::connection('tenant')->table('companies')->first();
            $logo = ($company && $company->logo)?'http://'.$row->hostname->fqdn.'/uploads/logos/'.$company->logo:null;
            //$logo = 'http://naed.facturaciondisoft.com/uploads/logos/logo_20602027601.png';

            return [
                'id' => $row->id,
                'url' => "http://".$row->hostname->fqdn,
                'logo' => $logo,
                'name' => $row->name,
                'number' => $row->number,
                
            ];
        });
    }
}