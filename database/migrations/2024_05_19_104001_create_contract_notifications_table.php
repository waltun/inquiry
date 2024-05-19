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
        Schema::create('contract_notifications', function (Blueprint $table) {
            $table->id();

            $table->text('message');
            $table->string('current_url')->nullable();
            $table->string('next_url')->nullable();
            $table->string('next_message')->nullable();

            $table->timestamp('read_at')->nullable();
            $table->timestamp('done_at')->nullable();

            $table->unsignedBigInteger('contract_id');
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
        Schema::dropIfExists('contract_notifications');
    }
};
