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
        Schema::create('fpa_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fpa_id')->constrained()->onDelete('cascade')->nullable();
            $table->foreignId('parameter_id')->constrained()->onDelete('cascade')->nullable();
            $table->string('std_parameter')->nullable();
            $table->string('unit')->nullable();
            $table->string('hasil_analisa')->nullable();
            $table->string('qc_analis')->nullable();
            $table->string('note')->nullable();
            $table->date('tgl_analisa')->nullable();
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
        Schema::dropIfExists('fpa_details');
    }
};
