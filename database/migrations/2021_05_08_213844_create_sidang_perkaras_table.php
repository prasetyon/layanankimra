<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSidangPerkarasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sidang_perkaras', function (Blueprint $table) {
            $table->id();
            $table->foreignId('perkara')->constraint('perkara_advokasis');
            $table->foreignId('type')->constraint('jenis_sidangs');
            $table->string('nomor_st');
            $table->date('tanggal');
            $table->longText('agenda')->nullable();
            $table->longText('majelis')->nullable();
            $table->longText('keterangan')->nullable();
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
        Schema::dropIfExists('sidang_perkaras');
    }
}
