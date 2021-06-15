<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengendalianInternalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengendalian_internals', function (Blueprint $table) {
            $table->id();
            $table->string('kegiatan');
            $table->string('tahun');
            $table->string('modul');
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
        Schema::dropIfExists('pengendalian_internals');
    }
}
