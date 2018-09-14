<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRealizacoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('realizacoes', function (Blueprint $table) {
            $table->increments('id');
            $table->date('data_real');
            $table->decimal('valor_real', 8, 2);
            $table->integer('id_conta')->unsigned();
            $table->foreign('id_conta')->references('id')->on('contas')->onDelete('cascade');
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
        Schema::drop('realizacoes');
    }
}
