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
        Schema::create('group_model_inquiry', function (Blueprint $table) {
            $table->id();

            $table->float('percent')->default(0);
            $table->integer('quantity')->default(0);

            $table->unsignedBigInteger('group_id');
            $table->unsignedBigInteger('model_id');
            $table->unsignedBigInteger('inquiry_id');

            $table->index(['group_id', 'model_id', 'inquiry_id']);
        });

        Schema::table('group_model_inquiry', function (Blueprint $table) {
            $table->foreign('group_id')->references('id')->on('groups');
            $table->foreign('model_id')->references('id')->on('modells');
            $table->foreign('inquiry_id')->references('id')->on('inquiries');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('group_model_inquiry');
    }
};
