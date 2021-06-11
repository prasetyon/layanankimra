<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilePengawasansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_pengawasans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengawasan')->constraint('pengawasans');
            $table->string('name');
            $table->string('file');
            $table->string('unit')->nullable();
            $table->string('type', 2);
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
        Schema::dropIfExists('file_pengawasans');
    }
}
