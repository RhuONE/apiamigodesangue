<?php

namespace App\Http\Controllers;

//Import criptografia de senha
use Illuminate\Support\Facades\Hash;

//Import erro de catch
use Illuminate\Database\Eloquent\ModelNotFoundException;

//Import request do banco
use Illuminate\Http\Request;

//Import Hemocentro
use App\Models\Hemocentro;

//Import Usuario
use App\Models\Usuario;

//Import log
use Illuminate\Support\Facades\Log;


class AuthController extends Controller
{
    //
    public function login(Request $request)
{
    // Verifique se o usuário é do tipo Hemocentro
    $hemocentro = Hemocentro::where('emailHemocentro', $request->email)->first();
    

    if ($hemocentro) {
        $isPasswordValid = Hash::check($request->senha, $hemocentro->senhaHemocentro);
    

        if ($isPasswordValid && $hemocentro->statusHemocentro === 'ativo') {
            $token = $hemocentro->createToken('Hemocentro')->plainTextToken;
            return response()->json([
                'message' => 'Autenticado como Hemocentro com sucesso!',
                'token' => $token
            ], 200);
        } else if($hemocentro->statusHemocentro === 'pendente') {
            return response()->json(['message' => 'Hemocentro pendente!'], 401);
        } else if($hemocentro->statusHemocentro === 'arquivado') {
            return response()->json(['message' => 'Hemocentro arquivado!'], 401);
        } else {
            return response()->json(['message' => 'Credenciais inválidas!'], 401);
        }
    }

    // Verifique se o usuário é do tipo admin
    $usuario = Usuario::where('emailUsuario', $request->email)->first();

    if ($usuario && $usuario->tipoUsuario === 'administrador') {
        $isPasswordValid = Hash::check($request->senha, $usuario->senhaUsuario);

        if ($isPasswordValid) {
            $token = $usuario->createToken('Admin')->plainTextToken;
            return response()->json([
                'message' => 'Autenticado como Administrador com sucesso!',
                'token' => $token
            ], 200);
        } else {
            return response()->json(['message' => 'Credenciais inválidas!'], 401);
        }
    }

    return response()->json([
        'message' => 'Usuário não encontrado ou credenciais inválidas!',
        'data' => $usuario,
        'request' => $request->email
    ], 401);
}


}
