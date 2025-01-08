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
        Schema::create('penilaian_pk', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dosen_id')->constrained('dosen')->cascadeOnDelete();
            $table->foreignId('pengawas_id')->constrained('pengawas')->cascadeOnDelete();
            $table->foreignId('periode_id')->constrained('periode')->onDelete('cascade');
            $table->tinyInteger('orientasi_pelayanan');
            $table->tinyInteger('integritas');
            $table->tinyInteger('komitmen');
            $table->tinyInteger('disiplin');
            $table->tinyInteger('kerjasama');
            $table->tinyInteger('kepemimpinan');
            $table->decimal('nilai_nsf');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('penilaian_sf');
    }
};
