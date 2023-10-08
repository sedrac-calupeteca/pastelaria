<?php

use App\Http\Controllers\{
    LojaController,
    HomeController,
    CompraController,
    PedidoController,
    ProdutoController,
    ClienteController,
    AvaliacaoController,
    EncomendaController,
    FuncionarioController,
    ProdutoCompraController,
    ProdutoEncomendaController
};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('loja/public',[LojaController::class,'public'])->name('loja.public');
Route::get('loja/produto',[LojaController::class,'json_produto'])->name('loja.produtos.json');

Route::middleware(['auth'])->group(function(){

    Route::get('compra/{id}/produtos',[ProdutoCompraController::class,'json_produto'])->name('compra.produtos.json');
    Route::get('encomenda/{id}/atender',[EncomendaController::class,'atender'])->name('encomenda.atender');

    Route::delete('encomenda/{id}/avaliacao',[AvaliacaoController::class,'encomenda_delete'])->name('avaliacao.encomenda.delete');
    Route::post('encomenda/{id}/avaliacao',[AvaliacaoController::class,'encomenda_add'])->name('avaliacao.encomenda.add');
    Route::put('encomenda/{id}/avaliacao',[AvaliacaoController::class,'encomenda_put'])->name('avaliacao.encomenda.put');
    Route::get('encomenda/{id}/avaliacao',[AvaliacaoController::class,'encomenda_list'])->name('avaliacao.encomenda.list');

    Route::resource('funcionarios',FuncionarioController::class);
    Route::resource('encomendas',EncomendaController::class);
    Route::resource('clientes',ClienteController::class);
    Route::resource('produtos',ProdutoController::class);
    Route::resource('compras',CompraController::class);

    Route::post('/account', [HomeController::class, 'update'])->name('account.update');
    Route::post('/password', [HomeController::class, 'password'])->name('account.pass');

    Route::put('/account/photo/{id}', [HomeController::class, 'photo'])->name('account.photo');
    Route::put('/produto/photo/{id}', [ProdutoController::class, 'photo'])->name('produtos.photo');

    Route::get('/json/cliente', [ClienteController::class, 'json_search'])->name('clientes.json.search');
    Route::get('/json/produto', [ProdutoController::class, 'json_search'])->name('produtos.json.search');

    Route::post('/produto/encomenda/{id}/add', [ProdutoEncomendaController::class, 'produto_add'])->name('produto.encomenda.add');
    Route::post('/produto/encomenda/{id}/list', [ProdutoEncomendaController::class, 'produto_list'])->name('produto.encomenda.list');

    Route::get('/produto/encomenda/{id}/list', [ProdutoEncomendaController::class, 'produto_list_json']);

    Route::get('loja/auth',[LojaController::class,'auth'])->name('loja.auth');
    Route::get('loja/{id}/auth',[LojaController::class,'auth_user'])->name('loja.auth.user');

    Route::post('loja/encomenda',[LojaController::class,'encomenda'])->name('loja.encomenda');
    Route::post('loja/compra',[LojaController::class,'compra'])->name('loja.compra');

});
