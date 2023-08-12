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
        Schema::create('coil_inputs', function (Blueprint $table) {
            $table->id();

            $table->string('loole_messi')->nullable();
            $table->string('fin_coil')->nullable();
            $table->string('tedad_radif_coil')->nullable();
            $table->string('fin_dar_inch')->nullable();
            $table->string('zekhamat_frame_coil')->nullable();
            $table->string('pooshesh_khordegi')->nullable();
            $table->string('collector_ahani')->nullable();
            $table->string('collector_messi')->nullable();
            $table->string('electrod_noghre')->nullable();
            $table->string('noe_coil')->nullable();
            $table->string('toole_coil')->nullable();
            $table->string('tedad_loole_dar_radif')->nullable();
            $table->string('tedad_mogheyiat_loole')->nullable();
            $table->string('tedad_madar_loole')->nullable();
            $table->string('kham')->nullable();
            $table->string('tedad_madar_coil')->nullable();
            $table->string('tedad_soorakh_pakhshkon')->nullable();
            $table->string('sathe_coil')->nullable();

            $table->string('type');
            $table->unsignedBigInteger('part_id');

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
        Schema::dropIfExists('coil_inputs');
    }
};
