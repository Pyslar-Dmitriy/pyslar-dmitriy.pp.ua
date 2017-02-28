<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'web'], function(){
    Route::get('/', function () {
        return view('.common.home');
    });

    Auth::routes();

    Route::get('/home', 'HomeController@index');

    Route::get('/portfolio', ['as' => 'portfolio', 'uses' => 'PortfolioController@index']);

    Route::any('/blog', ['as' => 'blog', 'uses' => 'BlogController@index']);

    Route::get('/blog/{filter}', ['as' => 'articlesFilter', 'uses' => 'BlogController@index']);

    Route::get('/portfolio/{tagId}', ['as' => 'worksFilter', 'uses' => 'PortfolioController@index']);

    Route::get('/profile', ['as' => 'profile', 'uses' => 'ProfileController@index'])->middleware('authenticate');

    Route::post('updateProfile', ['as' => 'updateProfile', 'uses' => 'ProfileController@update']);

    Route::post('sendMail', ['as' => 'sendMail', 'uses' => 'MailController@send']);

    Route::get('article_{id}', 'BlogController@showArticle');

    Route::get('switchLocale', function (){
        if(App::getLocale() == 'ru')
            session(['applocale' => 'en']);
        else
            session(['applocale' => 'ru']);
        return redirect()->back();
    });

    Route::group(['middleware' => 'isAdmin'], function () {
        Route::get('secret', ['as' => 'secret', 'uses' => 'SecretController@index']);

        Route::post('secret/addWork', ['as' => 'addWork', 'uses' => 'SecretController@createWork']);

        Route::get('secret/removeWork_{id}', ['as' => 'removeWork', 'uses' => 'SecretController@removeWork']);

        Route::get('secret/editWork_{id}', function ($id){
            return view('.dashboard.editWork', ['id' => $id]);
        });

        Route::post('secret/editWork', ['as' => 'editWork', 'uses' => 'SecretController@editWork']);

        Route::post('/secret/addCategory', ['as' => 'addCategory', 'uses' => 'SecretController@addCategory']);

        Route::get('/secret/removeCat_{id}', ['as' => 'removeCategory', 'uses' => 'SecretController@removeCategory']);

        Route::get('/secret/addArticle', ['as' => 'addArticle', 'uses' => 'SecretController@addArticleView']);
        
        Route::post('/secret/addArticle/add', ['as' => 'submitArticle', 'uses' => 'SecretController@addArticle']);
        
        Route::get('/secret/removeArticle_{id}', ['as' => 'removeArticle', 'uses' => 'SecretController@removeArticle']);
    });
});

