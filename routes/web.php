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

$router->get('/api/collections', ['middleware' => 'collectionMiddleware','uses' => 'CollectionsController@getCollections']);

$router->get('/api/communities', ['middleware' => 'communitiesMiddleware','uses' => 'CommunitiesController@getCommunities']);

$router->post('/api/indexing','IndexingController@setDspaceInformation');