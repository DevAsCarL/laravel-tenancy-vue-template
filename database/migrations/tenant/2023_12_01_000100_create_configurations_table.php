<?php

use App\Models\Tenant\IdentityDocumentType;
use App\Models\Tenant\SoapType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfigurationsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('configurations', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('send_auto');
            $table->boolean('openbox')->default(false);
            $table->string('contact_claim')->nullable();
            $table->string('text_extra')->nullable();
            $table->boolean('giftsale')->default(false);
            $table->boolean('salenote')->default(false);
            $table->boolean('invoice')->default(false);
            $table->boolean('viewpdfsale')->default(false);
            $table->boolean('separateaccount')->default(false);
            $table->boolean('corporatesale')->default(false);
            $table->boolean('manufacture')->default(false);
            $table->boolean('printsalenote')->default(false);
            $table->boolean('customgroupfilter')->default(false);
            $table->boolean('changetable')->default(false);
            $table->boolean('reportitem')->default(false);
            $table->boolean('roles_waitress_cashier')->default(false);
            $table->boolean('categorysupplie')->default(false);
            $table->boolean('listcomplement')->default(false);
            $table->boolean('listambient')->default(false);
            $table->boolean('listtable')->default(false);
            $table->boolean('isrestaurant')->default(false);
            $table->boolean('quotations')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('configurations');
    }
};
