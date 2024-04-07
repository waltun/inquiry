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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();

            $table->boolean('important')->default(false);
            $table->string('document_number')->nullable();
            $table->timestamp('date')->nullable();
            $table->string('title');
            $table->integer('request_quantity')->default(0);
            $table->enum('status', ['pending', 'accepted', 'failed', 'purchased']);
            $table->integer('accepted_quantity')->default(0);
            $table->string('unit')->nullable();
            $table->string('buy_location');
            $table->string('description')->nullable();
            $table->boolean('store')->default(0);
            $table->string('store_code')->nullable();
            $table->string('seller')->nullable();

            $table->unsignedBigInteger('coding_id')->nullable();
            $table->string('applicant');

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
        Schema::dropIfExists('purchases');
    }
};
