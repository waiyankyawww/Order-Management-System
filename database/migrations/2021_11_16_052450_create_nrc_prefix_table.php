<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNrcPrefixTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nrc_prefix', function (Blueprint $table) {
            $table->id();
            $table->string('township')->nullable();
            $table->string('prefix')->nullable();
            $table->string('state_id')->nullable();
            $table->string('state')->nullable();
            $table->string('nrc_format')->nullable();
            $table->string('prefix_en')->nullable();
            $table->string('state_id_en')->nullable();
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
        Schema::dropIfExists('nrc_prefix');
    }
}
