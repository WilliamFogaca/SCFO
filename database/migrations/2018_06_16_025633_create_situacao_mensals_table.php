<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSituacaoMensalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('situacao_mensals', function (Blueprint $table) {
            $table->increments('id');
            $table->date('data');
            $table->decimal('saldo_inicial_previsto', 8, 2)->nullable();
            $table->decimal('saldo_final_previsto', 8, 2)->nullable();
            $table->decimal('saldo_inicial_real', 8, 2)->nullable();
            $table->decimal('saldo_final_real', 8, 2)->nullable();
            $table->string('cpf_user')->unsigned();
            $table->foreign('cpf_user')->references('cpf')->on('users')->onDelete('cascade');
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
        Schema::drop('situacao_mensals');
    }
}
