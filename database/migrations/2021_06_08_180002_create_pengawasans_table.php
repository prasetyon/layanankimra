<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengawasansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengawasans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('aparat')->constraint('aparat_pemeriksas');
            $table->foreignId('jenis')->constraint('jenis_pengawasans');
            $table->string('tahun', 4);
            $table->string('kegiatan');

            $table->string('st')->nullable();
            $table->date('jangka_waktu')->nullable();
            $table->string('kontak')->nullable();

            $table->date('tanggal_entry')->nullable();
            $table->string('nd_entry')->nullable();
            $table->text('peserta_entry')->nullable();

            $table->date('tanggal_exit')->nullable();
            $table->string('nd_exit')->nullable();
            $table->text('peserta_exit')->nullable();

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
        Schema::dropIfExists('pengawasans');
    }
}
