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
        Schema::create('delete_buttons', function (Blueprint $table) {
            $table->id();

            $table->boolean('parts');
            $table->boolean('collection-parts');
            $table->boolean('collection-coil');
            $table->boolean('users');
            $table->boolean('inquiries');

            $table->boolean('active')->default(false);

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
        Schema::dropIfExists('delete_buttons');
    }
};
