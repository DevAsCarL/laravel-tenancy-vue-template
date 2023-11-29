<?php

use App\Models\System\Plan;
use App\Models\System\Status;
use Hyn\Tenancy\Models\Hostname;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Hostname::class)->constrained()->cascadeOnDelete()->nullable();
            $table->foreignIdFor(Plan::class)->constrained()->cascadeOnDelete()->nullable();
            $table->string('number');
            $table->string('name');
            $table->date('plan_start_date')->default(null)->nullable();
            $table->double('amount')->default(0)->nullable();
            $table->boolean('active')->default(false);
            $table->string('email');
            $table->string('token');
            $table->boolean('locked')->default(false);
            $table->foreignIdFor(Status::class)->constrained('status')->cascadeOnDelete()->default(1);
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
        Schema::dropIfExists('clients');
    }
}
