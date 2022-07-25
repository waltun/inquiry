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
        Schema::create('group_part', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('group_id');
            $table->unsignedBigInteger('part_id');

            $table->decimal('value', 8, 2)->default(0.00);

            $table->index(['group_id', 'part_id']);
        });

        Schema::table('group_part', function (Blueprint $table) {
            $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade');
            $table->foreign('part_id')->references('id')->on('parts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('group_part');
    }
};
