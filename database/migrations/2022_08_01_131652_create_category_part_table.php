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
        Schema::create('category_part', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('part_id');

            $table->index(['category_id', 'part_id']);
        });

        Schema::table('category_part', function (Blueprint $table) {
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('part_id')->references('id')->on('parts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_part');
    }
};
