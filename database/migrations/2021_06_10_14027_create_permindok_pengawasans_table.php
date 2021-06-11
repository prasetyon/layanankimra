<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermindokPengawasansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permindok_pengawasans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengawasan')->constraint('pengawasans');
            $table->string('surat');
            $table->string('nd');
            $table->date('deadline');
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
        Schema::dropIfExists('permindok_pengawasans');
    }
}
