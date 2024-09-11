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
        Schema::create('coding_exits', function (Blueprint $table) {
            $table->id();

            $table->string('name')->nullable();
            $table->decimal('quantity');
            $table->string('unit')->nullable();
            $table->string('description')->nullable();
            $table->string('getter_name')->nullable();
            $table->string('car_number')->nullable();
            $table->string('phone')->nullable();

            $table->timestamp('return_date')->nullable();

            $table->unsignedBigInteger('coding_id')->nullable();

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
        Schema::dropIfExists('coding_exits');
    }
};
