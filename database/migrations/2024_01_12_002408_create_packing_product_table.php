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
        Schema::create('contract_product_packing', function (Blueprint $table) {
            $table->id();

            $table->unsignedInteger('packing_id');
            $table->unsignedInteger('product_id');

            $table->integer('quantity')->default(0);

            $table->foreign('packing_id')->references('id')->on('packings')->onDelete('cascade');
            $table->foreign('contract_product_id')->references('id')->on('contract_products')->onDelete('cascade');

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
        Schema::dropIfExists('packing_product');
    }
};
