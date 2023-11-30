<?php

namespace Database\Seeders\Tenant;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run()
    {
        DB::connection('tenant')->table('status')->insert([['type' => 'inactive'], ['type' => 'active']]);
    }
}
