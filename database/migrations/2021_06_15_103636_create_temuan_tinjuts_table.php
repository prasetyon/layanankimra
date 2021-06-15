<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTemuanTinjutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temuan_tinjuts', function (Blueprint $table) {
            $table->id();
            $table->year('tahun');
            $table->string('nomor_temuan');
            $table->string('judul');
            $table->longText('uraian_rekomendasi')->nullable();
            $table->string('kode_rekomendasi');
            $table->date('target')->nullable();
            $table->string('uic_es1');
            $table->string('uic_es2');
            $table->foreignId('jenis_pemeriksaan')->constraint('jenis_pemeriksaans');
            $table->string('uic_es3')->nullable();
            $table->foreignId('aparat_pemeriksa')->constraint('aparat_pemeriksas');
            $table->string('aparat_pemeriksa_lainnya')->nullable();
            $table->longText('keterangan')->nullable();
            $table->longText('catatan')->nullable();
            $table->longText('tinjut')->nullable();
            $table->foreignId('status_uic')->constraint('status_aksis');
            $table->foreignId('status_apk')->constraint('status_aksis');
            $table->foreignId('forum_bpk')->constraint('status_aksis');
            $table->string('approval', 1)->default('0');
            $table->foreignId('updated_by')->constraint('users');
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
        Schema::dropIfExists('temuan_tinjuts');
    }
}
