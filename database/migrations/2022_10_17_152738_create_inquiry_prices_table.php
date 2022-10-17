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
        Schema::create('inquiry_prices', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('part_id');
            $table->unsignedBigInteger('inquiry_id');
            $table->unsignedBigInteger('user_id');

            $table->index(['part_id', 'inquiry_id', 'user_id']);

            $table->timestamps();
        });

        Schema::table('inquiry_prices', function (Blueprint $table) {
            $table->foreign('part_id')->references('id')->on('parts')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('inquiry_id')->references('id')->on('inquiries')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inquiry_prices');
    }
};
