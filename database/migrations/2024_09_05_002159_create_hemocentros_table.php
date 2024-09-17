<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHemocentrosTable extends Migration
{
    public function up()
    {
        Schema::create('tbHemocentro', function (Blueprint $table) {
            $table->id('idHemocentro');
            $table->string('fotoHemocentro')->nullable();
            $table->string('nomeHemocentro');
            $table->text('descHemocentro')->nullable();
            $table->string('telHemocentro');
            $table->string('cepHemocentro');
            $table->string('logHemocentro');
            $table->string('numLogHemocentro');
            $table->string('compHemocentro')->nullable();
            $table->string('bairroHemocentro');
            $table->string('cidadeHemocentro');
            $table->string('estadoHemocentro');
            $table->string('emailHemocentro')->unique();
            $table->string('senhaHemocentro');
            $table->decimal('latitudeHemocentro', 10, 7)->nullable();
            $table->decimal('longitudeHemocentro', 10, 7)->nullable();
            $table->enum('statusHemocentro', ['pendente', 'ativo', 'arquivado'])->default('pendente');  // Enum com os três status
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tbHemocentro');
    }
}

