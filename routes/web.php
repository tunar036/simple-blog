<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Backend routes
|--------------------------------------------------------------------------
*/

Route::get('site-is-not-active',function(){
    return view('front.offline');
});

Route::prefix('admin')->name('admin.')->middleware('isLogin')->group(function () {
    Route::get('login','Back\AuthController@login')->name('login');
    Route::post('login','Back\AuthController@loginPost')->name('login.post');
});
Route::prefix('admin')->name('admin.')->middleware('isAdmin')->group(function () {
    Route::get('panel','Back\Dashboard@index')->name('dashboard');
    //ARTICLE ROUTES
    Route::get('/articles/deleted','Back\ArticleController@trashed')->name('trashed.article');
    Route::resource('articles','Back\ArticleController');
    Route::get('/switch','Back\ArticleController@switch')->name('switch');
    Route::get('/deletearticle{id}','Back\ArticleController@delete')->name('delete.article');
    Route::get('/harddeletearticle{id}','Back\ArticleController@hardDelete')->name('hard.delete.article');
    Route::get('/recoverarticle{id}','Back\ArticleController@recover')->name('recover.article');
    //CATEGORY ROUTES
    Route::get('categories','Back\CategoryController@index')->name('category.index');
    Route::post('categories/create','Back\CategoryController@create')->name('category.create');
    Route::post('categories/update','Back\CategoryController@update')->name('category.update');
    Route::post('categories/delete','Back\CategoryController@delete')->name('category.delete');
    Route::get('category/status','Back\CategoryController@switch')->name('category.switch');
    Route::get('category/getData','Back\CategoryController@getData')->name('category.getdata');
    //PAGE'S ROUTE
    Route::get('pages','Back\PageController@index')->name('page.index');
    Route::get('pages/create','Back\PageController@create')->name('page.create');
    Route::get('pages/update/{id}','Back\PageController@update')->name('page.edit');
    Route::post('pages/update/{id}','Back\PageController@updatePost')->name('page.edit.post');
    Route::post('pages/create','Back\PageController@post')->name('page.create.post');
    Route::get('/page/switch','Back\PageController@switch')->name('page.switch');
    Route::get('/page/delete/{id}','Back\PageController@delete')->name('page.delete');
    Route::get('/page/orders','Back\PageController@orders')->name('page.orders');
    //CONFIG'S ROUTE
    Route::get('/settings','Back\ConfigController@index')->name('config.index');
    Route::post('/settings/update','Back\ConfigController@update')->name('config.update');
    //
    Route::get('logout','Back\AuthController@logout')->name('logout');
});


/*
|--------------------------------------------------------------------------
| Front routes
|--------------------------------------------------------------------------
*/

Route::get('/','Front\Homepage@index')->name('homepage'); 
Route::get('.','Front\Homepage@index');
Route::get('/contact','Front\Homepage@contact')-> name('contact');
Route::post('/contact','Front\Homepage@contactpost')-> name('contact.post');
Route::get('/category/{category}','Front\Homepage@category')->name('category');
Route::get('/{category}/{slug}','Front\Homepage@single')-> name('single');
Route::get('/{sehife}','Front\Homepage@page')-> name('page');

