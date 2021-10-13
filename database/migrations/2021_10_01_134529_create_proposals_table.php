<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProposalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proposals', function (Blueprint $table) {
            $table->id();
            $table->string('jenis');
            $table->string('kebutuhan'); //kebutuhan
            $table->string('upload_foto'); //upload foto
            $table->string('upload_proposal'); //upload proposal
            $table->string('persentase'); //persentase kerusakan

            $table->boolean('status_usulan');
            $table->boolean('status_pekerjaan');
            $table->string('id_user');
            $table->string('npsn');

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
        Schema::dropIfExists('proposals');
    }
}
