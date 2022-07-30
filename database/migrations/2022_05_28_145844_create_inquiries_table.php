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
        Schema::create('inquiries', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('manager');
            $table->string('marketer');
            $table->string('inquiry_number');
            $table->bigInteger('price')->default(0);

            $table->text('message')->nullable();

            $table->timestamp('archive_at')->nullable();

            $table->boolean('submit')->default(false);

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
        Schema::dropIfExists('inquiries');
    }
};
