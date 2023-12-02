<?php

use App\Models\Tenant\Establishment;
use App\Models\Tenant\Person;
use App\Models\Tenant\PosStatus;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pos', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Person::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Establishment::class)->constrained();
            $table->foreignIdFor(PosStatus::class)->constrained('pos_status');
            $table->float('cash_limit', 15, 4)->default(2000);
            $table->float('open_amount', 15, 4);
            $table->float('close_amount', 15, 4)->default(0)->nullable();
            $table->float('close_amount_cash', 15, 4)->default(0)->nullable();
            $table->float('close_amount_visa', 15, 4)->default(0)->nullable();
            $table->float('close_amount_mastercard', 15, 4)->default(0)->nullable();
            $table->float('close_amount_visa_glovo', 15, 4)->default(0)->nullable();
            $table->integer('sales_count')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pos');
    }
}
