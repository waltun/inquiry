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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('price')->default(0);
            $table->string('text')->nullable();
            $table->timestamp('date')->nullable();
            $table->string('type')->nullable();
            $table->string('cash_type')->nullable();
            $table->boolean('confirm')->default(0);

            $table->unsignedBigInteger('account_id')->nullable();
            $table->unsignedBigInteger('contract_id')->nullable();

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
        Schema::dropIfExists('payments');
    }
};
