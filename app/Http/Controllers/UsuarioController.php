<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\FoneUsuario;
use App\Models\Telefone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class UsuarioController extends Controller
{
    //
    public function store(Request $request){

        //Validação
        $request->validate([
            'nomeUsuario' => 'required|string|max:255',
            'dataNascUsuario' => 'required|date',
            'generoUsuario' => 'required|string|max:10',
            'emailUsuario' => 'required|string|email|max:255|unique:tbUsuario,emailUsuario',
            'senhaUsuario' => 'required|string|min:8',
            'cpfUsuario' => 'required|string|size:11|unique:tbUsuario,cpfUsuario',
            'logUsuario' => 'required|string|max:255',
            'numLogUsuario' => 'required|string|max:10',
            'compUsuario' => 'nullable|string|max:255',
            'bairroUsuario' => 'required|string|max:255',
            'cidadeUsuario' => 'required|string|max:255',
            'estadoUsuario' => 'required|string|max:2',
            'cepUsuario' => 'required|string|max:8',
            'rgUsuario' => 'required|string|max:20',
            'numTelefone' => 'required|string',
            'descTipoSanguineo' => 'required|string'
        ]);
         // Upload da imagem (se houver)
         if ($request->hasFile('fotoUsuario')) {
            $path = $request->file('fotoUsuario')->store('uploads/usuarios', 'public');
            $fotoHemocentroUrl = Storage::url($path);
        } else {
            $fotoHemocentroUrl = null;
        }

        //Inserção
        $usuario = Usuario::create([
            'nomeUsuario' => $request->input('nomeUsuario'),
            'dataNascUsuario' => $request->input('dataNascUsuario'),
            'generoUsuario' => $request->input('generoUsuario'),
            'emailUsuario' => $request->input('emailUsuario'),
            'senhaUsuario' => Hash::make($request->input('senhaUsuario')),
            'cpfUsuario' => $request->input('cpfUsuario'),
            'logUsuario' => $request->input('logUsuario'),
            'numLogUsuario' => $request->input('numLogUsuario'),
            'compUsuario' => $request->input('compUsuario'),
            'bairroUsuario' => $request->input('bairroUsuario'),
            'cidadeUsuario' => $request->input('cidadeUsuario'),
            'estadoUsuario' => $request->input('estadoUsuario'),
            'cepUsuario' => $request->input('cepUsuario'),
            'rgUsuario' => $request->input('rgUsuario'),
            'descTipoSanguineo' => $request->input('descTipoSanguineo'),
            'statusUsuario' => 'ativo',
            'tipoUsuario' => 'doador'
        ]);

        $telefone = Telefone::create([
            'numTelefone' => $request->input('numTelefone')
        ]);
        $foneUsuario = FoneUsuario::create([
            'numFoneUsuario' => $request->input('numTelefone'),
            'idUsuario' => $usuario->idUsuario,
            'idTelefone' => $telefone->idTelefone
        ]);


        //Retorno
        return response()->json([
            'message' => 'Usuario cadastrado com sucesso!',
            'data' => $usuario
        ], 201);
    }

    public function login(Request $request){

        //Validar os dados
        $request->validate([
            'emailUsuario'=> 'required|email',
            'senhaUsuario' => 'required'
        ]);

        //Tentando autenticar
        $usuario = Usuario::where('emailUsuario', $request->emailUsuario)->first();

        if(!$usuario || !Hash::check($request->senhaUsuario, $usuario->senhaUsuario )) {
            return response()->json(['message' => 'Credenciais inválidas'], 401);
        }
        if($usuario->statusUsuario === 'arquivado'){
            return response()->json(['message' => 'Essa conta foi excluída'], 403);
        }

        //Gerar token
        $token = $usuario->createToken('Doador')->plainTextToken;

        return response()->json([
            'message' => 'Login bem-sucedido',
            'token' => $token,
        ]);
    }

    public function show(Request $request)
    {
        // Obtém o token do header Authorization
        $usuario = Auth::user();

        if (!$usuario) {
            return response()->json(['message' => 'Usuário não autenticado.'], 401);
        }
    
        if ($usuario->statusUsuario === 'arquivado') {
            return response()->json(['message' => 'Usuário arquivado.'], 403); // Forbidden
        }
    
        // Retorne os dados do perfil
        return response()->json($usuario);
    }
    
    // Método de atualização
    public function update(Request $request)
    {
        // Obter o usuário autenticado
        $usuario = Auth::user();

        if (!$usuario) {
            return response()->json(['message' => 'Usuário não autenticado.'], 401);
        }

        // Validar os dados enviados
        $request->validate([
            'nomeUsuario' => 'required|string|max:255',
            'emailUsuario' => 'required|string|email|max:255|unique:tbUsuario,emailUsuario,' . $usuario->idUsuario. ',idUsuario',
        
            // Adicione outras validações conforme necessário
        ]);

        try {
        
            // Atualizar os campos do usuário
            
            $usuario->update([
            'nomeUsuario' => $request->input('nomeUsuario'),
            'dataNascUsuario' => $request->input('dataNascUsuario'),
            'generoUsuario' => $request->input('generoUsuario'),
            'emailUsuario' => $request->input('emailUsuario'),
            'senhaUsuario' => Hash::make($request->input('senhaUsuario')),
            'cpfUsuario' => $request->input('cpfUsuario'),
            'logUsuario' => $request->input('logUsuario'),
            'numLogUsuario' => $request->input('numLogUsuario'),
            'compUsuario' => $request->input('compUsuario'),
            'bairroUsuario' => $request->input('bairroUsuario'),
            'cidadeUsuario' => $request->input('cidadeUsuario'),
            'estadoUsuario' => $request->input('estadoUsuario'),
            'cepUsuario' => $request->input('cepUsuario'),
            'rgUsuario' => $request->input('rgUsuario'),
            'descTipoSanguineo' => $request->input('descTipoSanguineo'),
            'statusUsuario' => 'ativo',
            'tipoUsuario' => 'doador']);
           
            

            // Retornar a resposta de sucesso
            return response()->json(['message' => 'Usuário atualizado com sucesso!', 'usuario' => $usuario], 200);
        } catch (\Exception $e) {
            // Retornar erro caso ocorra uma exceção
            return response()->json(['error' => 'Erro ao atualizar o usuário.'], 500);
        }
    }

    //Método de arquivar
    public function delete(Request $request){
         // Obter o usuário autenticado
         $usuario = Auth::user();

         if (!$usuario) {
             return response()->json(['message' => 'Usuário não autenticado.'], 401);
         }

         $usuario->statusUsuario = "arquivado";

         try{
            $usuario->save();

            return response()->json([
                'message' => 'Usuário arquivado com sucesso',
                'nomeUsuario' => $usuario->nomeUsuario,
                'statusUsuario' => $usuario->statusUsuario
            ]);
        } catch (\Exception $e) {
            // Retornar erro caso ocorra uma exceção
            return response()->json(['error' => 'Erro ao arquivar o usuário.'], 500);
        }
    }


    public function storeAdm(Request $request){
        
        //Validação
        $request->validate([
            'nomeUsuario' => 'required|string|max:255',
            'dataNascUsuario' => 'required|date',
            'generoUsuario' => 'required|string|max:10',
            'emailUsuario' => 'required|string|email|max:255|unique:tbUsuario,emailUsuario',
            'senhaUsuario' => 'required|string|min:8',
            'cpfUsuario' => 'required|string|size:11|unique:tbUsuario,cpfUsuario',
            'logUsuario' => 'required|string|max:255',
            'numLogUsuario' => 'required|string|max:10',
            'compUsuario' => 'nullable|string|max:255',
            'bairroUsuario' => 'required|string|max:255',
            'cidadeUsuario' => 'required|string|max:255',
            'estadoUsuario' => 'required|string|max:2',
            'cepUsuario' => 'required|string|max:8',
            'numTelefone' => 'required|string',
            'descTipoSanguineo' => 'required|string'
        ]);
         // Upload da imagem (se houver)
         if ($request->hasFile('fotoUsuario')) {
            $path = $request->file('fotoUsuario')->store('uploads/usuarios', 'public');
            $fotoAdm = Storage::url($path);
        } else {
            $fotoAdm = null;
        }

        //Inserção
        $usuario = Usuario::create([
            'nomeUsuario' => $request->input('nomeUsuario'),
            'dataNascUsuario' => $request->input('dataNascUsuario'),
            'generoUsuario' => $request->input('generoUsuario'),
            'emailUsuario' => $request->input('emailUsuario'),
            'senhaUsuario' => Hash::make($request->input('senhaUsuario')),
            'cpfUsuario' => $request->input('cpfUsuario'),
            'logUsuario' => $request->input('logUsuario'),
            'numLogUsuario' => $request->input('numLogUsuario'),
            'compUsuario' => $request->input('compUsuario'),
            'bairroUsuario' => $request->input('bairroUsuario'),
            'cidadeUsuario' => $request->input('cidadeUsuario'),
            'estadoUsuario' => $request->input('estadoUsuario'),
            'cepUsuario' => $request->input('cepUsuario'),
            'rgUsuario' => $request->input('rgUsuario'),
            'descTipoSanguineo' => $request->input('descTipoSanguineo'),
            'statusUsuario' => 'ativo',
            'tipoUsuario' => 'administrador'
        ]);

        $telefone = Telefone::create([
            'numTelefone' => $request->input('numTelefone')
        ]);
        $foneUsuario = FoneUsuario::create([
            'numFoneUsuario' => $request->input('numTelefone'),
            'idUsuario' => $usuario->idUsuario,
            'idTelefone' => $telefone->idTelefone
        ]);


        //Retorno
        return response()->json([
            'message' => 'Administrador cadastrado com sucesso!',
            'data' => $usuario
        ], 201);
    }
    
}
