<?php

namespace Database\Seeders\Tenant;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DocumentTypesSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run()
    {
        $data = [
            ['code' => '01', 'status_id' => 2, 'short' => 'FT', 'description' => 'FACTURA ELECTRÓNICA'],
            ['code' => '02', 'status_id' => 1, 'short' => 'CP', 'description' => 'COTIZACIÓN'],
            ['code' => '03', 'status_id' => 2, 'short' => 'BV', 'description' => 'BOLETA DE VENTA ELECTRÓNICA'],
            ['code' => '07', 'status_id' => 2, 'short' => 'NC', 'description' => 'NOTA DE CRÉDITO'],
            ['code' => '08', 'status_id' => 2, 'short' => 'ND', 'description' => 'NOTA DE DÉBITO'],
            ['code' => '09', 'status_id' => 2, 'short' => null, 'description' => 'GUIA DE REMISIÓN REMITENTE'],
            ['code' => '20', 'status_id' => 2, 'short' => null, 'description' => 'COMPROBANTE DE RETENCIÓN ELECTRÓNICA'],
            ['code' => '31', 'status_id' => 2, 'short' => null, 'description' => 'Guía de remisión transportista'],
            ['code' => '40', 'status_id' => 2, 'short' => null, 'description' => 'COMPROBANTE DE PERCEPCIÓN ELECTRÓNICA'],
            ['code' => '71', 'status_id' => 1, 'short' => null, 'description' => 'Guia de remisión remitente complementaria'],
            ['code' => '72', 'status_id' => 1, 'short' => null, 'description' => 'Guia de remisión transportista complementaria'],
            ['code' => '100', 'status_id' => 2, 'short' => 'NV', 'description' => 'NOTA DE VENTA'],
            ['code' => '104', 'status_id' => 2, 'short' => 'GS', 'description' => 'GUÍA DE VENTA NV'],
            ['code' => '101', 'status_id' => 2, 'short' => 'GO', 'description' => 'GUÍA DE SALIDA INTERNA'],
            ['code' => '102', 'status_id' => 2, 'short' => 'GE', 'description' => 'GUÍA DE ENTRADA INTERNA'],
            ['code' => '06', 'status_id' => 2, 'short' => 'AN', 'description' => 'Anulación de Notas de Ventas'],
        ];

        DB::connection('tenant')->table('document_types')->insert($data);
    }
}
