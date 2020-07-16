<?php
use App\Commande;
use App\Commune;
use App\Wilaya;

Route::view('/', 'welcome');
Auth::routes();

Route::get('/login/admin', 'Auth\LoginController@showAdminLoginForm')->name('login.admin');
Route::get('/login/livreur', 'Auth\LoginController@showLivreurLoginForm')->name('login.Livreur');
Route::get('/register/admin', 'Auth\RegisterController@showAdminRegisterForm')->name('register.admin');
Route::get('/register/livreur', 'Auth\RegisterController@showLivreurRegisterForm')->name('register.Livreur');

Route::post('/login/admin', 'Auth\LoginController@adminLogin');
Route::post('/login/livreur', 'Auth\LoginController@livreurLogin');
Route::post('/register/admin', 'Auth\RegisterController@createAdmin')->name('register.admin');
Route::post('/register/livreur', 'Auth\RegisterController@createLivreur')->name('register.Livreur');

Route::get('/home', function(){
    $commandes = Commande::all();
    $communes = Commune::all();
    $wilayas =Wilaya::all();
    return view('home',compact('commandes','wilayas','communes'));

});
Route::group(['middleware' => 'auth:admin'], function () {
    Route::view('/admin', 'admin');
});

Route::group(['middleware' => 'auth:livreur'], function () {
    Route::view('/livreur', 'Livreur');
    Route::get('/commande/prendre/{id_commande}', ['as' => 'commande.prendre', 'uses' => 'CommandeController@prendre']);

});



Route::group(['prefix' => 'commande', 'as' => 'commande'], function () {
    Route::get('/', ['as' => '.index', 'uses' => 'CommandeController@index']);
    Route::get('/show/create',['as'=>'.show.create', 'uses' => 'CommandeController@create']);
    Route::post('/create', ['as' => '.create', 'uses' => 'CommandeController@store']);
    Route::get('/destroy/{id_commande}', ['as' => '.destroy', 'uses' => 'CommandeController@destroy']);    
    Route::get('/relancer/{id_commande}', ['as' => '.relancer', 'uses' => 'CommandeController@relancer']);    
    Route::get('/edit/{id_demande}', ['as' => '.edit', 'uses' => 'CommandeController@edit']);
    Route::get('/show/{id_demande}', ['as' => '.show', 'uses' => 'CommandeController@show']);
    Route::post('/update/{id_demande}', ['as' => '.update', 'uses' => 'CommandeController@update']);    
    Route::post('/search', ['as' => '.search', 'uses' => 'CommandeController@search']);    
    
});


Route::group(['prefix' => 'user', 'as' => 'user'], function () {
    Route::get('/', ['as' => '.index', 'uses' => 'UserController@index']);
    Route::get('/show/create',['as'=>'.show.create', 'uses' => 'UserController@create']);
    Route::post('/create', ['as' => '.create', 'uses' => 'UserController@store']);
    Route::get('/destroy/{id_user}', ['as' => '.destroy', 'uses' => 'UserController@destroy']);    
    Route::get('/edit/{id_user}', ['as' => '.edit', 'uses' => 'UserController@edit']);
    Route::get('/show/{id_user}', ['as' => '.show', 'uses' => 'UserController@show']);
    Route::post('/update/{id_user}', ['as' => '.update', 'uses' => 'UserController@update']);    
});


Route::group(['prefix' => 'produit', 'as' => 'produit'], function () {
    Route::get('/', ['as' => '.index', 'uses' => 'ProduitController@index']);
    Route::get('/show/create',['as'=>'.show.create', 'uses' => 'ProduitController@create']);
    Route::post('/create', ['as' => '.create', 'uses' => 'ProduitController@store']);
    Route::get('/destroy/{id_demande}', ['as' => '.destroy', 'uses' => 'ProduitController@destroy']);    
    Route::get('/edit/{id_demande}', ['as' => '.edit', 'uses' => 'ProduitController@edit']);
    Route::get('/show/{id_demande}', ['as' => '.show', 'uses' => 'ProduitController@show']);
    Route::post('/update/{id_demande}', ['as' => '.update', 'uses' => 'ProduitController@update']);    
});

Route::group(['prefix' => 'livreur', 'as' => 'livreur'], function () {
    Route::get('/', ['as' => '.index', 'uses' => 'LivreurController@index']);
    Route::get('/show/create',['as'=>'.show.create', 'uses' => 'LivreurController@create']);
    Route::post('/create', ['as' => '.create', 'uses' => 'LivreurController@store']);
    Route::get('/destroy/{id_livruer}', ['as' => '.destroy', 'uses' => 'LivreurController@destroy']);    
    Route::get('/change/state/{id_livruer}', ['as' => '.change.state', 'uses' => 'LivreurController@changeState']);
    Route::get('/show/{id_livruer}', ['as' => '.show', 'uses' => 'LivreurController@show']);
    Route::post('/update/{id_livruer}', ['as' => '.update', 'uses' => 'LivreurController@update']);    
    Route::get('/livraisons', ['as' => '.livraisons', 'uses' => 'LivreurController@maList']);    
});


Route::group(['prefix' => 'fournisseur', 'as' => 'fournisseur'], function () {
    Route::get('/', ['as' => '.index', 'uses' => 'FournisseurController@index']);
    Route::get('/show/create',['as'=>'.show.create', 'uses' => 'FournisseurController@create']);
    Route::post('/create', ['as' => '.create', 'uses' => 'FournisseurController@store']);
    Route::get('/destroy/{id_fournisseur}', ['as' => '.destroy', 'uses' => 'FournisseurController@destroy']);    
    Route::get('/edit/{id_fournisseur}', ['as' => '.edit', 'uses' => 'FournisseurController@edit']);
    Route::get('/show/{id_fournisseur}', ['as' => '.show', 'uses' => 'FournisseurController@show']);
    Route::post('/update/{id_fournisseur}', ['as' => '.update', 'uses' => 'FournisseurController@update']);    
});


