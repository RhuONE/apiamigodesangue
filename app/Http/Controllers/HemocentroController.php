<?php

namespace App\Http\Controllers;

use App\Models\Hemocentro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class HemocentroController extends Controller
{

    public function index()
    {
        // Obter o usuário autenticado
         $usuario = Auth::user();

         if (!$usuario) {
             return response()->json(['message' => 'Usuário não autenticado.'], 401);
         }

         $hemocentros = Hemocentro::all();

         try{
            return response()->json($hemocentros);
        } catch (\Exception $e) {
            // Retornar erro caso ocorra uma exceção
            return response()->json(['error' => 'Erro ao lisar hemocenteos'], 500);
        }
    }

    public function store(Request $request)
    {
        // Validação dos dados recebidos
        $request->validate([
            'nomeHemocentro'   => 'required|string|max:255',
            'descHemocentro'   => 'nullable|string',
            'telHemocentro'    => 'required|string|max:20',
            'cepHemocentro'    => 'required|string|max:10',
            'logHemocentro'    => 'required|string|max:255',
            'numLogHemocentro' => 'required|string|max:10',
            'compHemocentro'   => 'nullable|string|max:255',
            'bairroHemocentro' => 'required|string|max:255',
            'cidadeHemocentro' => 'required|string|max:255',
            'estadoHemocentro' => 'required|string|max:2',
            'emailHemocentro'  => 'required|email|max:255|unique:tbHemocentro,emailHemocentro',
            'senhaHemocentro'  => 'required|string|min:8',
            // 'fotoHemocentro'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048',  // Validação da imagem
            'latitudeHemocentro'  => 'nullable|numeric|between:-90,90',
            'longitudeHemocentro' => 'nullable|numeric|between:-180,180',
        ]);

        // // Upload da imagem (se houver)
        // if ($request->hasFile('fotoHemocentro')) {
        //     $path = $request->file('fotoHemocentro')->store('uploads/hemocentros', 'public');
        //     $fotoHemocentroUrl = Storage::url($path);
        // } else {
        //     $fotoHemocentroUrl = null;
        // }

        // Inserção dos dados no banco de dados
        $hemocentro = Hemocentro::create([
            'nomeHemocentro'   => $request->input('nomeHemocentro'),
            'descHemocentro'   => $request->input('descHemocentro'),
            'telHemocentro'    => $request->input('telHemocentro'),
            'cepHemocentro'    => $request->input('cepHemocentro'),
            'logHemocentro'    => $request->input('logHemocentro'),
            'numLogHemocentro' => $request->input('numLogHemocentro'),
            'compHemocentro'   => $request->input('compHemocentro'),
            'bairroHemocentro' => $request->input('bairroHemocentro'),
            'cidadeHemocentro' => $request->input('cidadeHemocentro'),
            'estadoHemocentro' => $request->input('estadoHemocentro'),
            'emailHemocentro'  => $request->input('emailHemocentro'),
            'senhaHemocentro'  => Hash::make($request->input('senhaHemocentro')),  // Criptografia da senha
            // 'fotoHemocentro'   => $fotoHemocentroUrl,
            'latitudeHemocentro'  => $request->input('latitudeHemocentro'),
            'longitudeHemocentro' => $request->input('longitudeHemocentro'),
            'statusHemocentro' => 'pendente',  // Status padrão como "pendente"
        ]);

        // Retorna uma resposta de sucesso com o novo hemocentro
        return response()->json([
            'message' => 'Hemocentro cadastrado com sucesso!',
            'status' => 'Sucess',
            'data'    => $hemocentro
        ], 201);
    }

    public function update(Request $request){

        $hemocentro = Auth::user();

        if(!$hemocentro){
            return response()->json(['message' => 'Hemocentro não autenticado'], 401);
        }

        // Validação dos dados recebidos
        $request->validate([
            'nomeHemocentro'   => 'required|string|max:255',
            'descHemocentro'   => 'nullable|string',
            'telHemocentro'    => 'required|string|max:20',
            'cepHemocentro'    => 'required|string|max:10',
            'logHemocentro'    => 'required|string|max:255',
            'numLogHemocentro' => 'required|string|max:10',
            'compHemocentro'   => 'nullable|string|max:255',
            'bairroHemocentro' => 'required|string|max:255',
            'cidadeHemocentro' => 'required|string|max:255',
            'estadoHemocentro' => 'required|string|max:2',
            'emailHemocentro'  => 'required|email|max:255',
            'senhaHemocentro'  => 'required|string|min:8',
            // 'fotoHemocentro'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048',  // Validação da imagem
            'latitudeHemocentro'  => 'nullable|numeric|between:-90,90',
            'longitudeHemocentro' => 'nullable|numeric|between:-180,180',
        ]);

        try{
            
           
            $hemocentro->update([
                'nomeHemocentro'   => $request->input('nomeHemocentro'),
                'descHemocentro'   => $request->input('descHemocentro'),
                'telHemocentro'    => $request->input('telHemocentro'),
                'cepHemocentro'    => $request->input('cepHemocentro'),
                'logHemocentro'    => $request->input('logHemocentro'),
                'numLogHemocentro' => $request->input('numLogHemocentro'),
                'compHemocentro'   => $request->input('compHemocentro'),
                'bairroHemocentro' => $request->input('bairroHemocentro'),
                'cidadeHemocentro' => $request->input('cidadeHemocentro'),
                'estadoHemocentro' => $request->input('estadoHemocentro'),
                'emailHemocentro'  => $request->input('emailHemocentro'),
                //'senhaHemocentro'  => Hash::make($request->input('senhaHemocentro')),  // Criptografia da senha
                // 'fotoHemocentro'   => $fotoHemocentroUrl,
                'latitudeHemocentro'  => $request->input('latitudeHemocentro'),
                'longitudeHemocentro' => $request->input('longitudeHemocentro'),
            ]);

             // Retorna uma resposta de sucesso com o novo hemocentro
            return response()->json([
                'message' => 'Hemocentro atualizado com sucesso!',
                'status' => 'Sucess',
                'data'    => $hemocentro
            ], 201);

        }catch(ModelNotFoundException $e){

            return response()->json([
                'message' => 'hemocentro não encontrado',
                'status' => 'error'
            ], 404);
        }
    }


    //Mostrar dados Hemocentro
    public function show(Request $request)
    {
        // Obtém o token do header Authorization
        $hemocentro = Auth::user();

        if (!$hemocentro) {
            return response()->json(['message' => 'Hemocentro não autenticado.'], 401);
        }
    
        if ($hemocentro->statusHemocentro === 'arquivado') {
            return response()->json(['message' => 'Usuário arquivado.'], 403); // Forbidden
        }
    
        // Retorne os dados do perfil
        return response()->json($hemocentro);
    }

    //Request é JSON body, idHemocentro é a variável que vc vai mandar na url
    public function aceitar(Request $request, string $idHemocentro){

        try{
            //Procurar hemocentro baseado no id
            $hemocentro = Hemocentro::findOrFail($idHemocentro);
            //Definindo o status para ativo
            $hemocentro->statusHemocentro = "ativo";

            //Salvando o novo status no banco
            $hemocentro->save();

            //Retorando um resposta json de sucesso
            return response()->json([
                'message' => 'hemocentro ativado com sucesso',
                'status' => 'Sucess',
                //hemocentro atualizado:
                'data' => $hemocentro
            ], 200);

        //se não der certo, message de erro:
        }catch(ModelNotFoundException $e){
            return response()->json([
                'message' => 'hemocentro não encontrado',
                'status' => 'error'
            ], 404);
        }
    }

    //Request é JSON body, idHemocentro é a variável que vc vai mandar na url
    public function arquivar(Request $request, string $idHemocentro){

        try{
            //Procurar hemocentro baseado no id
            $hemocentro = Hemocentro::findOrFail($idHemocentro);
            //Definindo o status para ativo
            $hemocentro->statusHemocentro = "arquivado";

            //Salvando o novo status no banco
            $hemocentro->save();

            //Retorando um resposta json de sucesso
            return response()->json([
                'message' => 'hemocentro arquivado com sucesso',
                'status' => 'Sucess',
                //hemocentro atualizado:
                'data' => $hemocentro
            ], 200);

        //se não der certo, message de erro:
        }catch(ModelNotFoundException $e){
            return response()->json([
                'message' => 'hemocentro não encontrado',
                'status' => 'error'
            ], 404);
        }
    }
    
}
