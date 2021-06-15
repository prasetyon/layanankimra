<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToPengendalianInternalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pengendalian_internals', function (Blueprint $table) {
            $table->string('status')->default('perencanaan');
        });

        Schema::table('proses_pengendalian_internals', function (Blueprint $table) {
            $table->string('from')->nullable();
            $table->string('to')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pengendalian_internals', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        Schema::table('proses_pengendalian_internals', function (Blueprint $table) {
            $table->dropColumn('from');
            $table->dropColumn('to');
        });
    }
}
