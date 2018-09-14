<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', ['middleware' => 'auth', 'uses' => 'ContaController@criarSaldo']);

Route::group(['prefix' => 'cadastro', 'middleware' => 'auth'], function () {
    Route::group(['prefix' => 'conta'], function () {
        Route::get('/', 'ContaController@index')->name('cadastro.conta');
        Route::get('/find/{id}', 'ContaController@findOne');
        Route::get('/findAll', 'ContaController@findAll');
        Route::post('/save', 'ContaController@save');
        Route::get('/remove/{id}', 'ContaController@remove');
    });
    
    Route::group(['prefix' => 'previsao'], function () {
        Route::get('/', 'PrevisaoController@index')->name('cadastro.previsao');
        Route::get('/find/{id}', 'PrevisaoController@findOne');
        Route::get('/findAll', 'PrevisaoController@findAll');
        Route::post('/save', 'PrevisaoController@save');
        Route::get('/remove/{id}', 'PrevisaoController@remove');
    });
    
    Route::group(['prefix' => 'realizacao'], function () {
        Route::get('/', 'RealizacaoController@index')->name('cadastro.realizacao');
        Route::get('/find/{id}', 'RealizacaoController@findOne');
        Route::get('/findAll', 'RealizacaoController@findAll');
        Route::post('/save', 'RealizacaoController@save');
        Route::get('/remove/{id}', 'RealizacaoController@remove');
    });
});

Route::group(['prefix' => 'relatorio', 'middleware' => 'auth'], function () {
    Route::get('/comparativo', 'ComparacaoController@relatorio');
    
    Route::get('/conta', 'ContaController@relatorio');
    
    Route::get('/previsao', 'PrevisaoController@relatorio');
    
    Route::get('/realizacao', 'RealizacaoController@relatorio');
    
    Route::get('/saldo', 'SituacaoMensalController@relatorio');
});


Route::auth();

Route::group(['prefix' => 'profile', 'middleware' => 'auth'], function () {
        Route::get('/', 'ProfileController@index')->name('auth.profile');
        Route::get('/ativaInput', 'ProfileController@ativaInput');
        Route::post('/update', 'ProfileController@update');
        Route::post('/update_avatar', 'ProfileController@update_avatar');
});

