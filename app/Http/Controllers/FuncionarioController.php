<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Funcionario;
use App\Models\Hemocentro;
use App\Models\Telefone;
use App\Models\FoneFuncionario;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class FuncionarioController extends Controller
{
    //

    //Listar todos os funcionários
    public function index(){

        $funcionarios = Funcionario::all();

        return response()->json($funcionarios);
    }


    //Cadastrar funcionário
    public function store(Request $request){

        //Validação
        $request->validate([
            'nomeFuncionario' => 'required|string|max:255',
            'cpfFuncionario' => 'required|string',
            'descFuncionario' => 'nullable|string|max:255',
            'emailFuncionario' => 'required|string|email|max:255|unique:tbFuncionario,emailFuncionario',
            'numTelefone' => 'required|string',
            'idHemocentro' => 'required'
        ]);

        //Inserção
        $funcionario = Funcionario::create([
            'nomeFuncionario' => $request->input('nomeFuncionario'),
            'cpfFuncionario' => $request->input('cpfFuncionario'),
            'descFuncionario' => $request->input('descFuncionario'),
            'emailFuncionario' => $request->input('emailFuncionario'),
            'statusFuncionario' => 'ativo',
            'idHemocentro' => $request->input('idHemocentro')
        ]);

        $telefone = Telefone::create([
            'numTelefone' => $request->input('numTelefone')
        ]);

        $fonefuncionario = FoneFuncionario::create([
            'numFoneFuncionario' => $request->input('numTelefone'),
            'idFuncionario' => $funcionario->idFuncionario,
            'idTelefone' => $telefone->idTelefone
        ]); 

        //Retorno
        return response()->json([
            'message' => 'Funcionario cadastrado com sucesso!',
            'data' => $funcionario
        ], 201);
    }

    public function update(Request $request, int $idFuncionario){

        $funcionario = Funcionario::findOrFail($idFuncionario);

        $request->validate([
            'nomeFuncionario' => 'required|string|max:255',
            //'cpfFuncionario' => 'required|string',
            'descFuncionario' => 'nullable|string|max:255',
            'emailFuncionario' => 'required|string|email|max:255|unique:tbFuncionario,emailFuncionario',
            'numTelefone' => 'required|string',
            'idHemocentro' => 'required'
        ]);

        try{
            //Atualização de dados
            $funcionario->update([
                'nomeFuncionario' => $request->input('nomeFuncionario'),
                //'cpfFuncionario' => $request->input('cpfFuncionario'),
                'descFuncionario' => $request->input('descFuncionario'),
                'emailFuncionario' => $request->input('emailFuncionario'),
                'idHemocentro' => $request->input('idHemocentro')
            ]);

            return response()->json([
                'message' => 'Funcionario atualizado com sucesso!',
                'status' => 'sucess',
                'data' => $funcionario
            ], 201);

        }catch(ModelNotFoundException $e){

            return response()->json([
                'message' => 'Funcionario não encontrado',
                'status' => 'error'
            ],404);

        }
    }

    //Mostar dados Funcionario
    public function show(int $idFuncionario){
        
        $funcionario = Funcionario::findOrFail($idFuncionario);

        try{
            return response()->json($funcionario, 200);
        } catch(ModelNotFoundException $e){
            return response()->json([
                'message' => 'Funcionário não encontrado',
                'status' => 'error'
            ]);
        }

    }

    public function delete(int $idFuncionario){

        $funcionario = Funcionario::findOrFail($idFuncionario);

        try{

            $funcionario->statusFuncionario = 'arquivado';

            $funcionario->save();

            return response()->json([
                'message' => 'Funcionário arquivado com sucesso',
                'status' => 'Sucess',
                'data' => $funcionario
            ], 200);

        }catch(ModelNotFoundException $e){

            return response()->json([
                'message' => 'Funcionário não encontrado',
                'status' => 'error'
            ], 404);

        }

    }
   

}
