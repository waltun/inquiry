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
        Schema::create('attribute_value_part', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('part_id');
            $table->unsignedBigInteger('attribute_value_id');
        });

        Schema::table('attribute_value_part', function (Blueprint $table) {
            $table->foreign('part_id')->references('id')->on('parts')->onDelete('cascade');
            $table->foreign('attribute_value_id')->references('id')->on('attribute_values')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attribute_value_part');
    }
};
