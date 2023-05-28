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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('price')->default(0);
            $table->text('description')->nullable();
            $table->boolean('complete')->default(0);
            $table->boolean('tax')->default(0)->nullable();
            $table->string('buyer_name')->nullable();
            $table->string('buyer_position')->nullable();

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('inquiry_id');

            $table->timestamps();
        });

        Schema::table('invoices', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('inquiry_id')->references('id')->on('inquiries')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
};
