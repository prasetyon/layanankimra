<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestPengawasanUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_pengawasan_units', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengawasan')->constraint('pengawasans');
            $table->string('unit');
            $table->string('keterangan');
            $table->string('status');
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
        Schema::dropIfExists('request_pengawasan_units');
    }
}
