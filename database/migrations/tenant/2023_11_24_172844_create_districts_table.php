<?php

use App\Models\Tenant\Catalogs\Province;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDistricsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('districts', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->foreignIdFor(Province::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Status::class)->constrained('status')->cascadeOnDelete()->default(2);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('districts');
    }
};
