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
        Schema::create('packs', function (Blueprint $table) {
            $table->id();

            $table->string('code')->nullable();
            $table->string('name');
            $table->decimal('weight', 8, 2);
            $table->bigInteger('length')->default(0);
            $table->bigInteger('width')->default(0);
            $table->bigInteger('height')->default(0);
            $table->string('type')->nullable();

            $table->unsignedBigInteger('packing_id');

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
        Schema::dropIfExists('packs');
    }
};
