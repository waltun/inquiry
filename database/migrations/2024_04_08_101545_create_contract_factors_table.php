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
        Schema::create('contract_factors', function (Blueprint $table) {
            $table->id();

            $table->string('file');
            $table->bigInteger('price')->default(0);
            $table->bigInteger('tax_price')->default(0);
            $table->string('number')->nullable();
            $table->timestamp('date')->nullable();

            $table->unsignedBigInteger('contract_id');

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
        Schema::dropIfExists('contract_factors');
    }
};
