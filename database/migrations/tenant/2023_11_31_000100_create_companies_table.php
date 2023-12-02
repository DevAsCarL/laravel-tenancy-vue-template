<?php

use App\Models\Tenant\IdentityDocumentType;
use App\Models\Tenant\SoapType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->increments('id');
            $table->foreignIdFor(IdentityDocumentType::class)->constrained();
            $table->string('number');
            $table->string('name');
            $table->string('trade_name')->nullable();
            $table->string('subtitle')->nullable();
            $table->foreignIdFor(SoapType::class)->constrained();
            $table->string('soap_username')->nullable();
            $table->string('soap_password')->nullable();
            $table->string('certificate')->nullable();
            $table->string('logo')->nullable();
            $table->string('background')->nullable();
            $table->string('favicon')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
