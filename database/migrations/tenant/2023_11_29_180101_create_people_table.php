<?php

use App\Models\Tenant\Country;
use App\Models\Tenant\Department;
use App\Models\Tenant\District;
use App\Models\Tenant\Establishment;
use App\Models\Tenant\IdentityDocumentType;
use App\Models\Tenant\Province;
use App\Models\Tenant\Status;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('trade_name')->nullable();
            $table->foreignIdFor(IdentityDocumentType::class)->constrained()->cascadeOnDelete();
            $table->string('number');
            $table->foreignIdFor(Country::class)->constrained();
            $table->foreignIdFor(Department::class)->constrained();
            $table->foreignIdFor(Province::class)->constrained();
            $table->foreignIdFor(District::class)->constrained();
            $table->string('telephone')->nullable();
            $table->string('address')->nullable();
            $table->string('email')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->decimal('credit_pen',10,2)->default(0);
            $table->decimal('credit_usd',10,2)->default(0);
            $table->foreignIdFor(Establishment::class)->default(1)->constrained();
            $table->foreignIdFor(Status::class)->default(Status::ACTIVE)->constrained('status')->cascadeOnDelete();
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
