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
        Schema::create('pengawas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pengawas');
            $table->foreignId('jabatan_id')->constrained('jabatan')->onDelete('cascade'); // Pastikan nama tabel benar
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Ganti 'users_id' menjadi 'user_id'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('pengawas');
    }
};