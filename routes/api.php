<?php

use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\PacienteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostoController;

Route::post('posto/criar/', [PostoController::class, 'criarPosto']);
Route::get('posto/retornar/', [PostoController::class, 'retornarTodos']);
Route::put('/posto/atualizar', [PostoController::class, 'atualizarPosto']);
Route::delete('/posto/excluir/{posto}', [PostoController::class, 'excluirPosto']);

Route::post('departamento/cadastrar', [DepartamentoController::class, 'criarDepartamento']);
Route::get('departamento/todos', [DepartamentoController::class, 'listarDepartamentos']);
Route::get('departamento/encontrar/{id}', [DepartamentoController::class, 'buscarPorId']);
Route::put('departamento/atualizar/{id}', [DepartamentoController::class, 'atualizarDepartamento']);

Route::post('/funcionarios/criar', [FuncionarioController::class, 'criarFuncionario']);
Route::get('/funcionarios/all', [FuncionarioController::class, 'listarTodos']);
Route::get('/funcionarios/pesquisar/{id}', [FuncionarioController::class, 'pesquisarPorId']);
Route::put('/funcionarios/atualizar/{id}', [FuncionarioController::class, 'atualizarFuncionario']);
Route::delete('/funcionarios/excluir/{id}', [FuncionarioController::class, 'excluirFuncionario']);


Route::post('paciente/criar', [PacienteController::class, 'criarPaciente']);
Route::get('paciente/retornar/', [PacienteController::class, 'retornarTodos']);
Route::put('/paciente/atualizar', [PacienteController::class, 'atualizarPaciente']);
Route::delete('/paciente/excluir/{paciente}', [PacienteController::class, 'excluirPaciente']);

