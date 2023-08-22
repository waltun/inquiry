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
        Schema::create('contract_products', function (Blueprint $table) {
            $table->id();

            $table->integer('quantity');
            $table->bigInteger('price');
            $table->string('model_custom_name')->nullable();
            $table->text('description')->nullable();
            $table->string('type')->nullable();
            $table->timestamp('delivery_date')->nullable();
            $table->timestamp('warranty_date')->nullable();
            $table->string('tag')->nullable();

            $table->unsignedBigInteger('contract_id');
            $table->unsignedBigInteger('group_id')->nullable();
            $table->unsignedBigInteger('model_id')->nullable();
            $table->unsignedBigInteger('part_id')->nullable();

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
        Schema::dropIfExists('contract_products');
    }
};
