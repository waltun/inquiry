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
        Schema::create('guarantees', function (Blueprint $table) {
            $table->id();

            $table->string('guarantee_type');
            $table->bigInteger('price')->default(0);
            $table->timestamp('date')->nullable();
            $table->timestamp('due_date')->nullable();
            $table->string('text')->nullable();
            $table->string('code')->nullable();
            $table->string('type')->nullable();
            $table->string('return_date')->nullable();
            $table->string('final_return_date')->nullable();
            $table->boolean('confirm')->default(0);
            $table->string('receiver')->nullable();
            $table->string('customer_receiver')->nullable();

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
        Schema::dropIfExists('guarantees');
    }
};
