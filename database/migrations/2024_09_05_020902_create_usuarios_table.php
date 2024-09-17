<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbUsuario', function (Blueprint $table) {
            $table->id('idUsuario'); // id
            $table->string('fotoUsuario')->nullable();
            $table->string('nomeUsuario'); // nomeUsuario
            $table->date('dataNascUsuario'); // dataNascUsuario
            $table->string('generoUsuario'); // generoUsuario
            $table->string('emailUsuario')->unique(); // emailUsuario
            $table->string('senhaUsuario'); // senhaUsuario
            $table->string('cpfUsuario')->unique(); // cpfUsuario
            $table->string('logUsuario'); // logUsuario
            $table->string('numLogUsuario'); // numLogUsuario
            $table->string('compUsuario')->nullable(); // compUsuario
            $table->string('bairroUsuario'); // bairroUsuario
            $table->string('cidadeUsuario'); // cidadeUsuario
            $table->string('estadoUsuario', 2); // estadoUsuario
            $table->string('cepUsuario'); // cepUsuario
            $table->string('rgUsuario')->nullable(); // rgUsuario
            $table->enum('statusUsuario', ['ativo', 'arquivado']); // statusUsuario
            $table->enum('tipoUsuario', ['doador', 'administrador']); // tipoUsuario
            $table->enum('descTipoSanguineo', ['O+', 'O-', 'A+', 'A-', 'B+', 'B-', 'AB+', 'AB-']);
            $table->timestamps(); // created_at e updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbUsuario');
    }
}
