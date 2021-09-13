<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notas', function (Blueprint $table) {
            $table->id();
            $table->string('nota');
            $table->string('data_nota');
            $table->string('nome_destino');
            $table->string('cpf_destino');
            $table->string('rua_destino');
            $table->string('num_destino');
            $table->string('bairro_destino');
            $table->string('municipio_destino');
            $table->string('uf_destino');
            $table->string('cep_destino');
            $table->foreignId('user_id')->constrained('users');
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
        Schema::dropIfExists('notas');
    }
}
