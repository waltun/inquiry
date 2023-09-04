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
        Schema::create('marketer_accounts', function (Blueprint $table) {
            $table->id();

            $table->string('bank_name');
            $table->string('account_number')->nullable();
            $table->string('card_number')->nullable();
            $table->string('shaba_number');
            $table->string('account_name')->nullable();

            $table->bigInteger('marketer_id');

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
        Schema::dropIfExists('marketer_accounts');
    }
};
