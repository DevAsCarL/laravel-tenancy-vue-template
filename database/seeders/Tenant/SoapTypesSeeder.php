<?php

namespace Database\Seeders\Tenant;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SoapTypesSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run()
    {
        $data = [
           ['description' => 'Demo'],
           ['description' => 'Producción']
        ];

        DB::connection('tenant')->table('soap_types')->insert($data);
    }
}
