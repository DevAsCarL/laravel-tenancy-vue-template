<?php

namespace Database\Seeders\System;

use App\Enums\Role;
use App\Models\System\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlanSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run()
    {
        DB::table('plans')->insert([
            ['name' => 'Mensual', 'months' => 1, 'locked' => 1],
            ['name' => 'Trimestral', 'months' => 3, 'locked' => 1],
            ['name' => 'Semestral', 'months' => 6, 'locked' => 1],
            ['name' => 'Anual', 'months' => 12, 'locked' => 1]
        ]);
    }
}
