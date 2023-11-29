<?php

namespace Database\Seeders;

use Database\Seeders\System\OrganisationsSeeder;
use Database\Seeders\System\PlanSeeder;
use Database\Seeders\System\RolesAndPermissionsSeeder;
use Database\Seeders\System\StatusSeeder;
use Database\Seeders\System\UsersSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            RolesAndPermissionsSeeder::class,
            UsersSeeder::class,
            StatusSeeder::class,
            PlanSeeder::class,
            OrganisationsSeeder::class,
        ]);
    }
}
