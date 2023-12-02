<?php

use App\Models\Tenant\Country;
use App\Models\Tenant\Department;
use App\Models\Tenant\District;
use App\Models\Tenant\Province;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstablishmentsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('establishments', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->foreignIdFor(Country::class)->constrained();
            $table->foreignIdFor(Department::class)->constrained();
            $table->foreignIdFor(Province::class)->constrained();
            $table->foreignIdFor(District::class)->constrained();
            $table->string('address');
            $table->string('email');
            $table->string('telephone');
            $table->string('code');
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('establishments');
    }
};
