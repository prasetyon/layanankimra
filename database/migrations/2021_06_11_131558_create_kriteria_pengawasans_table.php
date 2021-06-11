<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKriteriaPengawasansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kriteria_pengawasans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengawasan')->constraint('pengawasans');
            $table->string('surat');
            $table->string('nd');
            $table->date('deadline');
            $table->string('type');
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
        Schema::dropIfExists('kriteria_pengawasans');
    }
}
