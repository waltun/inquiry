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
        Schema::create('part_child', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('child_part_id');
            $table->unsignedBigInteger('parent_part_id');

            $table->decimal('value', '8', '2')->default(0.00);

            $table->index(['child_part_id', 'parent_part_id']);
        });

        Schema::table('part_child', function (Blueprint $table) {
            $table->foreign('child_part_id')->references('id')->on('parts')->onDelete('cascade');
            $table->foreign('parent_part_id')->references('id')->on('parts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('part_part');
    }
};
