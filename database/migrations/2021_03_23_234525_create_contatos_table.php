<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContatosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contatos', function (Blueprint $table) {
            $table->id();
            $table->string("nome");
            $table->string("email")->unique();
            $table->char("telefone", 11);
            $table->string("cep")->nullable();
            $table->string("bairro")->nullable();
            $table->string("cidade")->nullable();
            $table->text("logradouro")->nullable();
            $table->char("estado", 2)->nullable();
            $table->char("numero", 5)->nullable();
            $table->string("ref")->nullable();
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
        Schema::dropIfExists('contatos');
    }
}
