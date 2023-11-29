<?php

namespace Database\Seeders\System;

use App\Enums\Role;
use App\Models\System\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run()
    {
        DB::table('status')->insert([['type' => 'inactive'], ['type' => 'active']]);
    }
}
