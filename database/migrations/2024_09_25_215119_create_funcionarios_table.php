<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //
        Schema::create('tbFuncionario', function (Blueprint $table){
            $table->id('idFuncionario');
            $table->string('nomeFuncionario');
            //$table->string('fotoFuncionario')->nullable();
            $table->string('cpfFuncionario')->unique();
            $table->string('descFuncionario')->nullable();
            //$table->date('dataNascFuncionario');
            $table->string('emailFuncionario')->unique();
            $table->enum('statusFuncionario', ['ativo', 'arquivado']);
            $table->unsignedBigInteger('idHemocentro');
            $table->foreign('idHemocentro')->references('idHemocentro')->on('tbHemocentro')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('tbFuncionario');
    }
};
