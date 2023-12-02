<?php

namespace Database\Seeders\Tenant;

use App\Models\Tenant\IdentityDocumentType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IdentityDocumentTypesSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run()
    {
        IdentityDocumentType::insert([
            ['short' => '0', 'active' => 1, 'description' => 'Doc.trib.no.dom.sin.ruc'],
            ['short' => '1', 'active' => 1, 'description' => 'DNI'],
            ['short' => '4', 'active' => 1, 'description' => 'CE'],
            ['short' => '6', 'active' => 1, 'description' => 'RUC'],
            ['short' => '7', 'active' => 1, 'description' => 'Pasaporte'],
            ['short' => 'A', 'active' => 0, 'description' => 'Ced. Diplomática de identidad'],
            ['short' => 'B', 'active' => 0, 'description' => 'Documento identidad país residencia-no.d'],
            ['short' => 'C', 'active' => 0, 'description' => 'Tax Identification Number - TIN – Doc Trib PP.NN'],
            ['short' => 'D', 'active' => 0, 'description' => 'Identification Number - IN – Doc Trib PP. JJ'],
            ['short' => 'E', 'active' => 0, 'description' => 'TAM- Tarjeta Andina de Migración'],
        ]);
    }
}
