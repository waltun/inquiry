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
        Schema::create('invoice_products', function (Blueprint $table) {
            $table->id();

            $table->decimal('percent')->default(0);
            $table->integer('quantity')->default(0);
            $table->integer('quantity2')->default(0);
            $table->bigInteger('price')->default(0);
            $table->boolean('show_price')->nullable();

            $table->unsignedBigInteger('invoice_id');
            $table->unsignedBigInteger('product_id');

            $table->timestamps();
        });

        Schema::table('invoice_products', function (Blueprint $table) {
            $table->foreign('invoice_id')->references('id')->on('invoices')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice_products');
    }
};
