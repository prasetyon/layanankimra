<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMitigasiRisikosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mitigasi_risikos', function (Blueprint $table) {
            $table->id();
            $table->longText('kejadian');
            $table->longText('opsi');
            $table->longText('rencana_aksi');
            $table->longText('output');
            $table->longText('target');
            $table->longText('kendala');
            $table->longText('sumberdaya');
            $table->longText('jadwal');
            $table->string('penanggung_jawab');
            $table->year('tahun');
            $table->string('unit');
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
        Schema::dropIfExists('mitigasi_risikos');
    }
}
