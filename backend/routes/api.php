<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


// Route::middleware('auth:api')->group('/user', function (Request $request) {
//     return $request->user();
//     Route::post('armazenarpessoa', 'PessoaController@store');
//     Route::post('armazenarpessoa', 'PessoaController@store');
// });

Route::middleware(['auth:api'])->group(function () {
    // Route::post('armazenarpessoa', 'PessoaController@store');
    Route::get('/user', function () {
        return $request->user();
    });
    
});
header('Access-Control-Allow-Origin:  *');
header('Access-Control-Allow-Methods:  POST, GET, OPTIONS, PUT, PATCH, DELETE');
header('Access-Control-Allow-Headers:  Content-Type, X-Auth-Token, Origin, Authorization');
Route::resource('/tipopessoa', 'TipoPessoaController');
Route::resource('/tiposervico', 'TipoServicoController');
Route::resource('/pessoa', 'PessoaController');
Route::resource("/navios", "NavioController");
Route::resource("/oss", "OsController");
Route::resource("/oshaspessoas", "OsHasPessoasController");
Route::post('cadastrapessoa', 'PessoaController@store');
Route::post('cadastratipopessoa', 'TipoPessoaController@store');
Route::post('excluitipopessoa', 'TipoPessoaController@destroy');
Route::post('cadastracontato', 'ContatoController@store');
Route::post('cadastraos' , 'OsController@store');
Route::post('oshaspessoas', 'OsHasPessoasController@store');
Route::post('cadastranavio' , 'NavioController@store');
Route::post('cadastratiposervico', 'TipoServicoController@store');




