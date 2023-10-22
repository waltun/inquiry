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
        Schema::create('contract_part_histories', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('old_part_id');
            $table->unsignedBigInteger('new_part_id');
            $table->unsignedBigInteger('contract_product_id');
            $table->unsignedBigInteger('contract_id');
            $table->unsignedBigInteger('user_id');

            $table->string('type');

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
        Schema::dropIfExists('contract_part_histories');
    }
};
