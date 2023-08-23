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
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();

            $table->string('name')->nullable();
            $table->string('marketer')->nullable();
            $table->string('number')->nullable();
            $table->string('customer_number')->nullable();
            $table->string('period')->nullable();
            $table->bigInteger('price')->nullable();
            $table->boolean('tax')->nullable();

            $table->timestamp('build_date')->nullable();
            $table->timestamp('delivery_date')->nullable();
            $table->timestamp('start_contract_date')->nullable();
            $table->timestamp('sale_service_date')->nullable();
            $table->timestamp('send_date')->nullable();

            $table->unsignedBigInteger('invoice_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('customer_id')->nullable();

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
        Schema::dropIfExists('contracts');
    }
};
