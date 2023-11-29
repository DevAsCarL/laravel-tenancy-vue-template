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
            ['status' => 1, 'short' => 'FT', 'description' => 'FACTURA ELECTRÓNICA'],
            ['status' => 0, 'short' => 'CP', 'description' => 'COTIZACIÓN'],
            ['status' => 1, 'short' => 'BV', 'description' => 'BOLETA DE VENTA ELECTRÓNICA'],
            ['status' => 1, 'short' => 'NC', 'description' => 'NOTA DE CRÉDITO'],
            ['status' => 1, 'short' => 'ND', 'description' => 'NOTA DE DÉBITO'],
            ['status' => 1, 'short' => null, 'description' => 'GUIA DE REMISIÓN REMITENTE'],
            ['status' => 1, 'short' => null, 'description' => 'COMPROBANTE DE RETENCIÓN ELECTRÓNICA'],
            ['status' => 1, 'short' => null, 'description' => 'Guía de remisión transportista'],
            ['status' => 1, 'short' => null, 'description' => 'COMPROBANTE DE PERCEPCIÓN ELECTRÓNICA'],
            ['status' => 0, 'short' => null, 'description' => 'Guia de remisión remitente complementaria'],
            ['status' => 0, 'short' => null, 'description' => 'Guia de remisión transportista complementaria'],
            ['status' => 1, 'short' => 'NV', 'description' => 'NOTA DE VENTA'],
            ['status' => 1, 'short' => 'GS', 'description' => 'GUÍA DE VENTA NV'],
            ['status' => 1, 'short' => 'GO', 'description' => 'GUÍA DE SALIDA INTERNA'],
            ['status' => 1, 'short' => 'GE', 'description' => 'GUÍA DE ENTRADA INTERNA'],
            ['status' => 1, 'short' => 'AN', 'description' => 'Anulación de Notas de Ventas'],
        ];

        DB::connection('tenant')->table('cat_document_types')->insert($data);
    }
}
