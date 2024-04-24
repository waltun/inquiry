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
        Schema::create('old_serials', function (Blueprint $table) {
            $table->id();

            $table->string('year');
            $table->string('serial');
            $table->enum('type', ['official', 'operational']);
            $table->string('number');
            $table->string('buyer');
            $table->string('model');
            $table->timestamp('send_date')->nullable();

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
        Schema::dropIfExists('serials');
    }
};
