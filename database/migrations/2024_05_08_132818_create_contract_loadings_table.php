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
        Schema::create('contract_loadings', function (Blueprint $table) {
            $table->id();

            $table->string('number')->nullable();
            $table->string('file');
            $table->string('type');
            $table->timestamp('date');

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
        Schema::dropIfExists('contract_loadings');
    }
};
