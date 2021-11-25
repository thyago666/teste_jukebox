<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLivrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('livros', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome',120);
            $table->string('categoria',30);
            $table->string('codigo');
            $table->string('autor',120);
            $table->boolean('ebook');
            $table->string('tamanhoArquivo',120)->nullable();
            $table->float('peso')->nullable();
            $table->integer('pessoa')->unsigned();
            $table->foreign('pessoa')->references('id')->on('pessoas');
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
        Schema::dropIfExists('livros');
    }
}
