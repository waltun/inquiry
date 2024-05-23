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
        Schema::create('packings', function (Blueprint $table) {
            $table->id();

            $table->timestamp('date')->nullable();

            $table->unsignedBigInteger('contract_id');

            $table->string('address')->nullable();
            $table->string('driver_name')->nullable();
            $table->string('driver_nation')->nullable();
            $table->string('driver_type')->nullable();
            $table->string('driver_number')->nullable();

            $table->text('receiver')->nullable();
            $table->timestamp('exit_at')->nullable();

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
        Schema::dropIfExists('packings');
    }
};
