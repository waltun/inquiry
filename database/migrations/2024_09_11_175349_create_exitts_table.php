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
        Schema::create('exitts', function (Blueprint $table) {
            $table->id();

            $table->string('number')->unique();
            $table->timestamp('exit_at')->nullable();
            $table->enum('type', ['personal', 'mission', 'example', 'repair', 'other']);
            $table->string('exiter');
            $table->string('car_number')->nullable();
            $table->string('phone')->nullable();

            $table->string('mission_location')->nullable();
            $table->string('mission_reason')->nullable();
            $table->text('mission_users')->nullable();

            $table->boolean('accepted')->default(false);
            $table->boolean('confirm_quantity')->default(false);

            $table->string('description')->nullable();

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
