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
        Schema::create('leaves', function (Blueprint $table) {
            $table->id();

            $table->string('type');
            $table->timestamp('start_date');
            $table->timestamp('end_date')->nullable();
            $table->string('start_hour')->nullable();
            $table->string('end_hour')->nullable();
            $table->string('description');

            $table->boolean('confirm')->default(0);

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
        Schema::dropIfExists('leaves');
    }
};
