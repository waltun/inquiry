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
        Schema::create('contract_product_amounts', function (Blueprint $table) {
            $table->id();

            $table->decimal('value')->default(0);
            $table->decimal('value2')->nullable();
            $table->bigInteger('price')->default(0);
            $table->integer('sort')->default(0);
            $table->decimal('weight')->default(0);

            $table->unsignedBigInteger('part_id');
            $table->unsignedBigInteger('contract_product_id');

            $table->string('buyer_manage')->nullable();
            $table->unsignedBigInteger('buyer')->nullable();
            $table->string('status')->nullable();

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
        Schema::dropIfExists('contract_product_amounts');
    }
};
