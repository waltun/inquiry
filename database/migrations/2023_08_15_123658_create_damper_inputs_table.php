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
        Schema::create('damper_inputs', function (Blueprint $table) {
            $table->id();

            $table->string('debi_hava_taze')->nullable();
            $table->string('sorat_hava')->nullable();
            $table->string('tedad_pare')->nullable();
            $table->string('diomantion')->nullable();

            $table->string('type');
            $table->unsignedBigInteger('part_id')->nullable();
            $table->unsignedBigInteger('inquiry_id')->nullable();

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
        Schema::dropIfExists('damper_inputs');
    }
};
