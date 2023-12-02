<?php

namespace Database\Seeders\Tenant;

use Illuminate\Database\Seeder;

class DatabaseTenantSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            StatusSeeder::class,
            DocumentTypesSeeder::class,
            IdentityDocumentTypesSeeder::class,
            SoapTypesSeeder::class,
            LocationSeeder::class
        ]);
    }
}
