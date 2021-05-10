<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengaduansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengaduans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('type')->constraint('jenis_aduans');
            $table->longText('perihal');
            $table->date('tanggal');
            $table->longText('lokasi')->nullable();
            $table->longText('pihak')->nullable();
            $table->longText('kronologi')->nullable();
            $table->longText('motif')->nullable();
            $table->foreignId('created_by')->constraint('users');
            $table->string('status');
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
        Schema::dropIfExists('pengaduans');
    }
}
