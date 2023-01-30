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
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->decimal('percent', 5, 2)->default(0);
            $table->decimal('old_percent', 5, 2)->default(0);
            $table->integer('quantity')->default(0);
            $table->bigInteger('price')->default(0);
            $table->string('description')->nullable();
            $table->string('model_custom_name')->nullable();

            $table->unsignedBigInteger('group_id')->default(0);
            $table->unsignedBigInteger('model_id')->default(0);
            $table->unsignedBigInteger('inquiry_id');
            $table->unsignedBigInteger('part_id')->default(0);

            $table->bigInteger('part_price')->default(0)->nullable();

            $table->enum('copy_model', ['0', '1'])->default('0');
            $table->integer('sort')->default(0);

            $table->index(['group_id', 'model_id', 'inquiry_id', 'part_id']);

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
        Schema::dropIfExists('products');
    }
};
