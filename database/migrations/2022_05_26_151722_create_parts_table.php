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
            $table->string('unit');
            $table->bigInteger('price')->default(0);
            $table->bigInteger('old_price')->default(0);
            $table->string('code')->nullable();

            $table->boolean('collection')->default(false);
            $table->boolean('coil')->default(0);

            $table->index(['code']);

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
