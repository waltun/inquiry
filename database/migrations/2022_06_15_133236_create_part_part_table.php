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
        Schema::create('part_child', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('child_part_id');
            $table->unsignedBigInteger('parent_part_id');

            $table->integer('value')->nullable();
        });

        Schema::table('part_child', function (Blueprint $table) {
            $table->foreign('child_part_id')->references('id')->on('parts');
            $table->foreign('parent_part_id')->references('id')->on('parts');
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
