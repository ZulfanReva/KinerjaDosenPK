<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('penilaian_perilakukerja', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dosen_id')->constrained('dosen')->cascadeOnDelete();
            $table->string('periode');
            $table->tinyInteger('integritas');
            $table->tinyInteger('komitmen');
            $table->tinyInteger('kerjasama');
            $table->tinyInteger('orientasi_pelayanan');
            $table->tinyInteger('disiplin');
            $table->tinyInteger('kepemimpinan');
            $table->decimal('nilai_ncf');
            $table->decimal('nilai_nsf');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('penilaian_sf');
    }
};
