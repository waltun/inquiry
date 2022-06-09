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
        Schema::create('amounts', function (Blueprint $table) {
            $table->id();

            $table->integer('value');

            $table->unsignedBigInteger('part_id');
            $table->unsignedBigInteger('inquiry_id');

            $table->timestamps();
        });

        Schema::table('amounts', function (Blueprint $table) {
            $table->foreign('inquiry_id')->references('id')->on('inquiries')->onDelete('cascade');
            $table->foreign('part_id')->references('id')->on('parts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('amounts');
    }
};
