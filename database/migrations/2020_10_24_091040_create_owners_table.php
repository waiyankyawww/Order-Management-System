<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOwnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('owners', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('_token')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('nrc_no')->nullable();
            $table->string('nrc_location')->nullable();
            $table->string('nrc_type')->nullable();
            $table->string('nrc_number')->nullable();
            $table->string('email')->nullable();
            $table->string('password')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('org_name')->nullable();
            $table->string('industry')->nullable();
            $table->string('main_address')->nullable();
            $table->string('logo')->nullable();
            $table->string('amount')->nullable();
            $table->string('tax')->nullable();
            $table->string('total_amount')->nullable();
            $table->string('status')->nullable();
            $table->Integer('req_amount')->nullable();
            $table->string('invoice_id')->nullable();
            $table->string('created_by')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('owners');
    }
}
