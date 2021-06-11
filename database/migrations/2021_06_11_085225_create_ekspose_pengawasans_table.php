<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEksposePengawasansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ekspose_pengawasans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengawasan')->constraint('pengawasans');
            $table->string('surat');
            $table->string('und');
            $table->date('tanggal');
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
        Schema::dropIfExists('ekspose_pengawasans');
    }
}
