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
        Schema::create('modells', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('code');
            $table->decimal(5, 2)->default(0.00);
            $table->boolean('standard')->default(false);
            $table->unsignedBigInteger('group_id');
            $table->unsignedBigInteger('parent_id')->default(0);

            $table->index(['group_id', 'parent_id']);

            $table->timestamps();
        });

        Schema::table('modells', function (Blueprint $table) {
            $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('modells');
    }
};
