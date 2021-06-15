<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilePengendalianInternalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_pengendalian_internals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pi')->constraint('proses_pengendalian_internals');
            $table->string('name');
            $table->string('file');
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
        Schema::dropIfExists('file_pengendalian_internals');
    }
}
