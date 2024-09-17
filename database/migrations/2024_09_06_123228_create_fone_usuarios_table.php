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
        Schema::create('tbFoneUsuario', function (Blueprint $table) {
            $table->id('idFoneUsuario');
            $table->string('numFoneUsuario');
            $table->unsignedBigInteger('idUsuario'); // Adiciona a coluna idUsuario
            $table->unsignedBigInteger('idTelefone'); // Adiciona a coluna idTelefone
            $table->foreign('idUsuario')->references('idUsuario')->on('tbUsuario')->onDelete('cascade');
            $table->foreign('idTelefone')->references('idTelefone')->on('tbTelefone')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fone_users');
    }
};
