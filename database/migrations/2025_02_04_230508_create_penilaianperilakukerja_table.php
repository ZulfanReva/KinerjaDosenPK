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
            $table->foreignId('dosen_id')->constrained('dosen')->cascadeOnDelete(); // Dosen yang dinilai
            $table->foreignId('users_id')->constrained('users')->cascadeOnDelete(); // Dosen berjabatan yang menilai
            $table->foreignId('periode_id')->constrained('periode')->cascadeOnDelete(); // Dosen berjabatan yang menilai
            $table->date('tanggal_penilaian'); // Kolom baru untuk tanggal penilaian
            $table->tinyInteger('integritas');
            $table->tinyInteger('komitmen');
            $table->tinyInteger('kerjasama');
            $table->tinyInteger('orientasi_pelayanan');
            $table->tinyInteger('disiplin');
            $table->tinyInteger('kepemimpinan');
            $table->decimal('total_nilai');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('penilaian_sf');
    }
};
