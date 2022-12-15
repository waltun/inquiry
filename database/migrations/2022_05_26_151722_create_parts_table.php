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
        Schema::create('parts', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->bigInteger('price')->default(0);
            $table->bigInteger('old_price')->default(0);
            $table->string('code')->nullable();

            $table->boolean('collection')->default(false);
            $table->boolean('coil')->default(0);
            $table->boolean('standard')->default(0);

            $table->string('unit');
            $table->string('unit2')->nullable();
            $table->string('operator1')->nullable();
            $table->decimal('formula1')->nullable();
            $table->string('operator2')->nullable();
            $table->decimal('formula2')->nullable();
            $table->bigInteger('weight')->default(0);

            $table->unsignedBigInteger('inquiry_id')->nullable();
            $table->unsignedBigInteger('product_id')->nullable();

            $table->index(['code', 'inquiry_id', 'product_id']);

            $table->boolean('percent_submit')->default(0);
            $table->timestamp('price_updated_at')->nullable();
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
        Schema::dropIfExists('parts');
    }
};
