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
        Schema::create('coding_exits', function (Blueprint $table) {
            $table->id();

            $table->string('name')->nullable();
            $table->integer('quantity');
            $table->string('unit')->nullable();
            $table->integer('return_quantity')->nullable();
            $table->integer('return_date')->nullable();
            $table->string('description')->nullable();

            $table->unsignedBigInteger('coding_id')->nullable();
            $table->unsignedBigInteger('exitt_id');

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
        Schema::dropIfExists('coding_exits');
    }
};
