<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuditeePengendalianInternalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auditee_pengendalian_internals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pi')->constraint('pengendalian_internals');
            $table->string('unit');
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
        Schema::dropIfExists('auditee_pengendalian_internals');
    }
}
