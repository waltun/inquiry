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
        Schema::create('calculate_coil', function (Blueprint $table) {
            $table->id();

            $table->decimal('loole_messi')->default(0);
            $table->decimal('fin_coil')->default(0);
            $table->decimal('tedad_radif_coil')->default(0);
            $table->decimal('fin_dar_inch')->default(0);
            $table->decimal('kham')->default(0);
            $table->decimal('tedad_madar_coil')->default(0);
            $table->decimal('zekhamat_frame_coil')->default(0);
            $table->decimal('pooshesh_khordegi')->default(0);
            $table->decimal('collector_ahani')->default(0);
            $table->decimal('collector_messi')->default(0);
            $table->decimal('toole_coil')->default(0);
            $table->decimal('tedad_loole_dar_radif')->default(0);
            $table->decimal('tedad_mogheyiat_loole')->default(0);
            $table->decimal('tedad_madar_loole')->default(0);
            $table->decimal('tedad_soorakh_pakhshkon')->default(0);

            $table->bigInteger('price')->default(0);
            $table->unsignedBigInteger('inquiry_id');
            $table->enum('type', ['evaperator', 'condensor', 'water', 'fancoil']);

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
        Schema::dropIfExists('calculate_coil');
    }
};
