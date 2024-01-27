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
        Schema::create('stores', function (Blueprint $table) {
            $table->id();

            $table->string('code')->nullable();

            $table->string('name')->nullable();
            $table->decimal('quantity');
            $table->string('unit')->nullable();
            $table->enum('status', ['receipt', 'cost', 'trust', 'registering']);
            $table->enum('qc', ['confirmed', 'pending', 'canceled']);
            $table->string('description')->nullable();
            $table->integer('store')->nullable();

            $table->bigInteger('price')->default(0);
            $table->bigInteger('tax_price')->default(0);
            $table->bigInteger('duty_price')->default(0);
            $table->bigInteger('total_price')->default(0);
            $table->bigInteger('final_price')->default(0);

            $table->boolean('exported')->default(false);

            $table->timestamp('date')->nullable();

            $table->unsignedBigInteger('coding_id')->nullable();
            $table->unsignedBigInteger('factor_id')->nullable();

            $table->timestamps();
        });

        Schema::table('stores', function (Blueprint $table) {
            $table->foreign('coding_id')->references('id')->on('codings')->onDelete('cascade');
            $table->foreign('factor_id')->references('id')->on('factors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stores');
    }
};
