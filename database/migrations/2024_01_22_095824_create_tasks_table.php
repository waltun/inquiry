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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->text('description')->nullable();
            $table->timestamp('date');
            $table->boolean('done')->default(0);
            $table->enum('level', ['high', 'medium', 'low']);
            $table->string('file')->nullable();
            $table->string('reply')->nullable();

            $table->integer('extension_count')->default(2);
            $table->integer('extension_days')->default(7);
            $table->integer('extension_usage')->default(0);
            $table->integer('extension_days_request')->default(0);
            $table->timestamp('extension_days_request_at')->nullable();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('receiver_id');
            $table->foreign('receiver_id')->references('id')->on('users')->onDelete('cascade');

            $table->timestamp('done_at')->nullable();

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
        Schema::dropIfExists('tasks');
    }
};
