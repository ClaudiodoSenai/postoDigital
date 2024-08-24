<?php
    namespace App\Http\Controllers;
    
    use App\Http\Requests\FuncionarioFormRequest; 
    use App\Http\Requests\FuncionarioUpdateFormRequest; 
    use App\Models\Funcionario;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Hash;
    
    class FuncionarioController extends Controller
    {
        public function criarFuncionario(FuncionarioFormRequest $request)
        {
            $funcionario = Funcionario::create([
                'nome' => $request->nome,
                'celular' => $request->celular,
                'cpf' => $request->cpf,
                'numeroRegistro' => $request->numeroRegistro,
                'senha' => Hash::make($request->senha),
                'id_departamento' => $request->id_departamento,
            ]);
            return response()->json([
                "success" => true,
                "message" => "Funcionário cadastrado com sucesso",
                "data" => $funcionario
            ], 200);
        }
    
        public function listarTodos()
        {
            $funcionarios = Funcionario::all();
            return response()->json([
                'status' => true,
                'data' => $funcionarios
            ]);
        }
    
        public function pesquisarPorId($id)
        {
            $funcionario = Funcionario::find($id);
            if (!$funcionario) {
                return response()->json([
                    'status' => false,
                    'message' => "Funcionário não encontrado"
                ]);
            }
            return response()->json([
                'status' => true,
                'data' => $funcionario
            ]);
        }
    
        public function atualizarFuncionario(FuncionarioUpdateFormRequest $request)
        {
            $funcionario = Funcionario::find($request->id);
    
            if (!isset($funcionario)) {
                return response()->json([
                    'status' => false,
                    'message' => "Funcionário não encontrado"
                ]);
            }
    
            if (isset($request->nome)) {
                $funcionario->nome = $request->nome;
            }
    
            if (isset($request->celular)) {
                $funcionario->celular = $request->celular;
            }
    
            if (isset($request->cpf)) {
                $funcionario->cpf = $request->cpf;
            }
    
            if (isset($request->numeroRegistro)) {
                $funcionario->numeroRegistro = $request->numeroRegistro;
            }
    
            if (isset($request->id_departamento)) {
                $funcionario->id_departamento = $request->id_departamento;
            }
    
            if (isset($request->senha)) {
                $funcionario->senha = Hash::make($request->senha);
            }
    
            $funcionario->update();
    
            return response()->json([
                'status' => true,
                'message' => "Funcionário atualizado com sucesso",
                'data' => $funcionario
            ]);
        }
    
        public function excluirFuncionario(Request $request)
        {
            $funcionario = Funcionario::find($request->id);
            if (!$funcionario) {
                return response()->json([
                    'status' => false,
                    'message' => "Funcionário não encontrado"
                ]);
            }
            $funcionario->delete();
            return response()->json([
                'status' => true,
                'message' => "Funcionário excluído com sucesso"
            ]);
        }
    }
    

