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
        Schema::create('marketers', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('phone');
            $table->string('nation')->nullable();

            $table->string('bank_name1');
            $table->string('account_number1');
            $table->string('card_number1')->nullable();
            $table->string('shaba_number1')->nullable();

            $table->string('bank_name2')->nullable();
            $table->string('account_number2')->nullable();
            $table->string('card_number2')->nullable();
            $table->string('shaba_number2')->nullable();

            $table->string('bank_name3')->nullable();
            $table->string('account_number3')->nullable();
            $table->string('card_number3')->nullable();
            $table->string('shaba_number3')->nullable();

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
        Schema::dropIfExists('marketers');
    }
};
