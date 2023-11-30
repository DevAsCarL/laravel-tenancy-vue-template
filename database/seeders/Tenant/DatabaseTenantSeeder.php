<?php

namespace Database\Seeders\Tenant;

use Illuminate\Database\Seeder;

class DatabaseTenantSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            StatusSeeder::class,
            DocumentTypeSeeder::class,
            LocationSeeder::class
        ]);
    }
}
