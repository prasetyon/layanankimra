<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTypeToPendapatHukumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pendapat_hukums', function (Blueprint $table) {
            $table->foreignId('type')->constraint('jenis_perkaras');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pendapat_hukums', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }
}
