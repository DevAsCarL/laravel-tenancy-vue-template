<?php

namespace Database\Seeders\Tenant;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DocumentTypeSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run()
    {
        $data = [
            ['status_id' => 2, 'short' => 'FT', 'description' => 'FACTURA ELECTRÓNICA'],
            ['status_id' => 1, 'short' => 'CP', 'description' => 'COTIZACIÓN'],
            ['status_id' => 2, 'short' => 'BV', 'description' => 'BOLETA DE VENTA ELECTRÓNICA'],
            ['status_id' => 2, 'short' => 'NC', 'description' => 'NOTA DE CRÉDITO'],
            ['status_id' => 2, 'short' => 'ND', 'description' => 'NOTA DE DÉBITO'],
            ['status_id' => 2, 'short' => null, 'description' => 'GUIA DE REMISIÓN REMITENTE'],
            ['status_id' => 2, 'short' => null, 'description' => 'COMPROBANTE DE RETENCIÓN ELECTRÓNICA'],
            ['status_id' => 2, 'short' => null, 'description' => 'Guía de remisión transportista'],
            ['status_id' => 2, 'short' => null, 'description' => 'COMPROBANTE DE PERCEPCIÓN ELECTRÓNICA'],
            ['status_id' => 1, 'short' => null, 'description' => 'Guia de remisión remitente complementaria'],
            ['status_id' => 1, 'short' => null, 'description' => 'Guia de remisión transportista complementaria'],
            ['status_id' => 2, 'short' => 'NV', 'description' => 'NOTA DE VENTA'],
            ['status_id' => 2, 'short' => 'GS', 'description' => 'GUÍA DE VENTA NV'],
            ['status_id' => 2, 'short' => 'GO', 'description' => 'GUÍA DE SALIDA INTERNA'],
            ['status_id' => 2, 'short' => 'GE', 'description' => 'GUÍA DE ENTRADA INTERNA'],
            ['status_id' => 2, 'short' => 'AN', 'description' => 'Anulación de Notas de Ventas'],
        ];

        DB::connection('tenant')->table('document_types')->insert($data);
    }
}
