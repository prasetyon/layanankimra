<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFileTinjutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_tinjuts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tinjut')->constraint('temuan_tinjuts');
            $table->foreignId('data')->constraint('data_tinjuts');
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
        Schema::dropIfExists('file_tinjuts');
    }
}
