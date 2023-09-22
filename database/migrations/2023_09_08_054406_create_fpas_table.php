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
        Schema::create('fpas', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('item_id')->nullable();
            $table->unsignedInteger('purchase_id')->nullable();
            $table->unsignedInteger('category_item_id')->nullable();
            $table->string('no_lot')->nullable();
            $table->string('no_fpa')->nullable();
            $table->string('status_item')->nullable();
            $table->string('create_by')->nullable();
            $table->string('note')->nullable();
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
        Schema::dropIfExists('fpas');
    }
};
