<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fpa__details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('item_id')->nullable();
            $table->unsignedBigInteger('fpa_id')->nullable();
            $table->string('no_fpa')->nullable();
            $table->string('no_batch')->nullable();
            $table->string('parameter')->nullable();
            $table->string('std_parameter')->nullable();
            $table->string('unit')->nullable();
            $table->string('hasil_analisa')->nullable();
            $table->string('method')->nullable();
            $table->string('status_analisa')->nullable();
            $table->string('qc_analis')->nullable();
            $table->date('tgl_analisa')->nullable();
            $table->date('tgl_input')->nullable();
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
        Schema::dropIfExists('fpa__details');
    }
};
