<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMagasinsTable extends Migration
{
    public function up()
    {
        Schema::create('magasins', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedInteger('id_client');
            $table->foreign('id_client')->references('id')->on('clients')->onDelete('cascade')->onUpdate('cascade');
            $table->string('lieu');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('magasins');
    }
}