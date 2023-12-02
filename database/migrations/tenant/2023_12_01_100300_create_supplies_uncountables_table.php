<?php

use App\Models\System\Status;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuppliesUncountablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplies_uncountables', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->foreignIdFor(Status::class)->default(Status::ACTIVE)->constrained('status')->cascadeOnDelete();
            $table->string('type')->nullable()->default(null);
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
        Schema::dropIfExists('supplies_uncountables');
    }
}
