<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRisikosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('risikos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('piagam')->constraint('piagam_risikos');
            $table->foreignId('so')->constraint('sasaran_organisasis');
            $table->string('nama');
            $table->string('deskripsi');
            $table->string('formula');
            $table->float('batas_aman');
            $table->float('batas_atas');
            $table->float('batas_bawah');
            $table->string('satuan');
            $table->string('jenis_periode');
            $table->string('jenis_lokasi');
            $table->string('polarisasi');
            $table->string('penanggung_jawab');
            $table->string('penyedia_data');
            $table->string('sumber_data');
            $table->string('periode_pelaporan');
            $table->float('q1');
            $table->float('q2');
            $table->float('q3');
            $table->float('q4');
            $table->foreignId('created_by')->constraint('users');
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
        Schema::dropIfExists('risikos');
    }
}
