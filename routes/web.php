<?php

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

Route::get('/', 'RequestDocController@all');

    Auth::routes();
    
  //***************Routes concernant le controlleur RequestDocController****************************//
  //*******************************************************************************************************//

  //=======================Récupération de toutes les requests
  Route::get('apidocs', 'RequestDocController@all');
  
  //=======================Création d'une request
  Route::get('apidoc/create', 'RequestDocController@formRequest');
  Route::post('apidoc/request', 'RequestDocController@storeRequest');
  
  //=======================Ajout des paramètre de la request
  Route::get('apidoc/create/parameter/{requestdocId}', 'RequestDocController@formParams');
  Route::post('apidoc/params', 'RequestDocController@addParams');
  
  //=======================Supression du usertypes
  Route::delete('apidoc/{requestdocId}', 'RequestDocController@destroy');
  
  //=======================Modification du usertypes
  Route::put('apidoc', 'RequestDocController@store');