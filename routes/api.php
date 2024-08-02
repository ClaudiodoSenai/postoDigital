<?php



use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostoController;

// Rota para criar um novo posto
Route::post('/criar/posto', [PostoController::class, 'criarPosto']);

// Rota para retornar todos os postos
Route::get('/retornar/posto', [PostoController::class, 'retornarTodos']);

// Rota para atualizar um posto existente
Route::put('/postos/{posto}', [PostoController::class, 'atualizarPosto']);

// Rota para excluir um posto existente
Route::delete('/postos/{posto}', [PostoController::class, 'excluirPosto']);
