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
            $table->string('old_number')->nullable();
            $table->bigInteger('price')->nullable();
            $table->boolean('recipe')->default(0);
            $table->timestamp('start_contract_date')->nullable();
            $table->timestamp('send_date')->nullable();
            $table->string('type')->nullable();
            $table->boolean('complete')->default(0);

            $table->unsignedBigInteger('invoice_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('customer_id')->nullable();

            $table->timestamp('seen_at')->nullable();

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
