<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTanggapanToKriteriaPengawasansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kriteria_pengawasans', function (Blueprint $table) {
            $table->string('tanggapan')->nullable();
            $table->date('tanggal_tanggapan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kriteria_pengawasans', function (Blueprint $table) {
            $table->dropColumn('tanggapan');
            $table->dropColumn('tanggal_tanggapan');
        });
    }
}
