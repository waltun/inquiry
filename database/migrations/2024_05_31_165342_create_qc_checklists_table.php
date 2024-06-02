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
        Schema::create('checklists', function (Blueprint $table) {
            $table->id();

            $table->string('title');

            $table->timestamps();
        });

        Schema::create('checklist_group', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('checklist_id');
            $table->unsignedBigInteger('group_id');
            $table->integer('sort')->default(0);
            $table->boolean('completed')->default(false);
            $table->timestamp('completed_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('qc_checklists');
    }
};
