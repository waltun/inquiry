<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contract_packings', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->string('unit');
            $table->decimal('weight');
            $table->string('dimension');

            $table->unsignedBigInteger('contract_id');

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
        Schema::dropIfExists('contract_packings');
    }
};
