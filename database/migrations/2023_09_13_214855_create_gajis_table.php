<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('gajis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rekap_id');
            $table->string('karyawan');
            $table->string('jabatan');
            $table->integer('gapok');
            $table->string('periode');
            $table->date('tgl_awal');
            $table->date('tgl_akhir');
            $table->integer('masuk');
            $table->integer('jmlIzin');
            $table->integer('potonganIzin');
            $table->integer('jmlSakit');
            $table->integer('potonganSakit');
            $table->integer('jmlAlfa');
            $table->integer('potonganAlfa');
            $table->integer('jmlCuti');
            $table->integer('potonganCuti');
            $table->integer('thp');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gajis');
    }
};
