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
        Schema::create('modell_part', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('modell_id');
            $table->unsignedBigInteger('part_id');

            $table->decimal('value', 8, 2)->default(0.00);

            $table->index(['model_id', 'part_id']);
        });

        Schema::table('modell_part', function (Blueprint $table) {
            $table->foreign('model_id')->references('id')->on('modells')->onDelete('cascade');
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
        Schema::dropIfExists('modell_part');
    }
};
