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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();

            $table->string('type');
            $table->string('name');
            $table->string('nation')->nullable();
            $table->string('address')->nullable();
            $table->string('postal')->nullable();
            $table->string('registration_number')->nullable();
            $table->string('telephone')->nullable();
            $table->string('email')->nullable();
            $table->string('social_phone')->nullable();
            $table->string('phone')->nullable();

            $table->unsignedBigInteger('user_id');

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
        Schema::dropIfExists('customers');
    }
};
