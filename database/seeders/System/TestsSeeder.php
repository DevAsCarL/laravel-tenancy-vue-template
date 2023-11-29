<?php

namespace Database\Seeders\System;

use Illuminate\Database\Seeder;

class TestsSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            RolesAndPermissionsSeeder::class,
            UsersSeeder::class,
            OrganisationsSeeder::class,
        ]);
    }
}
