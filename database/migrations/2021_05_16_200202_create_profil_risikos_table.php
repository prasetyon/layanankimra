<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilRisikosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profil_risikos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('so')->constraint('sasaran_organisasis');
            $table->longText('kejadian');
            $table->longText('penyebab');
            $table->longText('dampak');
            $table->string('kategori');
            $table->longText('sistem');
            $table->string('lk_kemungkinan');
            $table->longText('penjelasan_kemungkinan');
            $table->string('ld_dampak');
            $table->longText('penjelasan_dampak');
            $table->string('besaran_risiko');
            $table->string('lr');
            $table->string('prioritas_risiko');
            $table->string('lk_risiko');
            $table->string('ld_risiko');
            $table->string('lr_risiko');
            $table->string('keputusan_mitigasi');
            $table->longText('nama_iru');
            $table->longText('batasan_nilai');
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
        Schema::dropIfExists('profil_risikos');
    }
}
