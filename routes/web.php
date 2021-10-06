<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->group(['prefix' => '/api'], function () use ($router) {

    $router->group(['prefix' => '/condutor'], function () use ($router){
        $router->get('', 'CondutorController@index');
        $router->post('', 'CondutorController@store');
        $router->get('/{id}', 'CondutorController@show');
        $router->put('/{id}', 'CondutorController@update');
        $router->delete('/{id}', 'CondutorController@destroy');

        $router->get('/cnh/{numero}', 'CondutorController@showByCnh');
        $router->get('/nome/{nome}', 'CondutorController@showByNome');
        $router->get('/categoria/{categoria}', 'CondutorController@showByCategoria');
    });

    $router->group(['prefix' => '/ordem'], function () use ($router){
        $router->get('', 'OrdemController@index');
        $router->post('', 'OrdemController@store');
        $router->delete('/{id}', 'OrdemController@destroy');
        $router->put('/{id}', 'OrdemController@update');
        $router->get('/veiculo/{veiculo}', 'OrdemController@showByVeiculo');
        $router->get('/condutor/{condutor}', 'OrdemController@showByCondutor');
        $router->get('/data/{data}', 'OrdemController@showByData');
        $router->get('/origem/{origem}', 'OrdemController@showByOrigem');
        $router->get('/destino/{destino}', 'OrdemController@showByDestino');
    });
    

    $router->group(['prefix' => '/veiculo'], function () use ($router){
        $router->get('', 'VeiculoController@index');
        $router->post('', 'VeiculoController@store');
        $router->put('/{id}', 'VeiculoController@update');
        $router->delete('/{id}', 'VeiculoController@destroy');
        $router->get('/marca/{marca}', 'VeiculoController@getByMarca');
        $router->get('/modelo/{modelo}', 'VeiculoController@getByModelo');
        $router->get('/intervaloQuilometragem', 'VeiculoController@getByIntervaloQuilometragem');
        $router->get('/estado/{estado}', 'VeiculoController@getByEstado');
    });

});

