<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('part_part', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('part_id');
            $table->unsignedBigInteger('part_collection_id');

            $table->integer('value')->nullable();
        });

        Schema::table('part_part', function (Blueprint $table) {
            $table->foreign('part_id')->references('id')->on('parts');
            $table->foreign('part_collection_id')->references('id')->on('parts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('part_part');
    }
};
