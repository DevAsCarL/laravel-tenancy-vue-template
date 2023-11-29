<?php

use App\Models\Tenant\DocumentType;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persons', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('type', ['customers', 'suppliers', 'employes']);
            $table->foreignIdFor(DocumentType::class)->constrained();
            $table->string('number');
            $table->string('name');
            $table->string('trade_name')->nullable();
            $table->foreignIdFor(DocumentType::class)->constrained();
            $table->foreignIdFor(Country::class)->constrained();
            $table->foreignIdFor(Department::class)->constrained();
            $table->foreignIdFor(Province::class)->constrained();
            $table->foreignIdFor(District::class)->constrained();
            $table->string('address')->nullable();
            $table->string('email')->nullable();
            $table->string('telephone')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('persons');
    }
}