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
        Schema::create('convertor_inputs', function (Blueprint $table) {
            $table->id();

            $table->string('loole_messi')->nullable();
            $table->string('size_loole_pooste')->nullable();
            $table->string('ayegh')->nullable();
            $table->string('flanch')->nullable();
            $table->string('tedad_madar')->nullable();
            $table->string('noe_bafel')->nullable();
            $table->string('toole_loole_pooste')->nullable();
            $table->string('tedad_bafel')->nullable();
            $table->string('tonaj')->nullable();
            $table->string('gaz')->nullable();

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
        Schema::dropIfExists('convertor_inputs');
    }
};
