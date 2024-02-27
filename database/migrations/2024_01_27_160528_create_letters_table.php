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
        Schema::create('letters', function (Blueprint $table) {
            $table->id();

            $table->string('number');
            $table->string('title');
            $table->string('method');
            $table->string('category');
            $table->timestamp('date');
            $table->text('description')->nullable();

            $table->unsignedBigInteger('contract_id')->nullable();
            $table->unsignedBigInteger('registrar');
            $table->unsignedBigInteger('user_id');

            $table->index(['user_id']);

            $table->timestamps();
        });

        Schema::table('letters', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('letters');
    }
};
