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
        Schema::create('tbFoneFuncionario', function (Blueprint $table){
            $table->id('idFoneFuncionario');
            $table->string('numFoneFuncionario');
            $table->unsignedBigInteger('idFuncionario');
            $table->unsignedBigInteger('idTelefone');
            $table->foreign('idFuncionario')->references('idFuncionario')->on('tbFuncionario')->onDelete('cascade');
            $table->foreign('idTelefone')->references('idTelefone')->on('tbTelefone')->onDelete('cascade');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('tbFoneFuncionario');

    }
};
