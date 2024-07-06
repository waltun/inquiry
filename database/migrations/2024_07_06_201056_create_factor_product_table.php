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
        Schema::create('contract_product_factor', function (Blueprint $table) {
            $table->id();

            $table->unsignedInteger('factor_id');
            $table->unsignedInteger('contract_product_id');

            $table->integer('quantity')->default(0);

            $table->foreign('factor_id')->references('id')->on('factors')->onDelete('cascade');
            $table->foreign('contract_product_id')->references('id')->on('contract_products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('factor_product');
    }
};
