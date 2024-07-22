<?php

use Illuminate\Support\Facades\Route;

Route::namespace('App\Http\Controllers')->group(function () {
    Route::get('/', 'HomeController@index')->name('home');

    Route::get('/login', 'LoginController@index')->name('login');
    Route::post('/login', 'LoginController@authenticate')->name('login.authenticate');

    Route::get('/register', 'RegisterController@index')->name('register');
    Route::post('/register', 'RegisterController@store')->name('register.store');

    Route::middleware('auth')->group(function () {
        Route::get('/logout', 'LoginController@logout')->name('logout');

        Route::namespace('User')->prefix('user')->group(function () {
            Route::get('/', 'HomeController@index')->name('index');

            Route::get('/transaction', 'TransactionController@index')->name('transaction.index');
            Route::post('/transaction', 'TransactionController@store')->name('transaction.store');

            Route::get('/cart', 'CartController@index')->name('cart.index');
            Route::post('/cart', 'CartController@add')->name('cart.add');
            Route::get('/cart/delete/{id}', 'CartController@delete')->name('cart.delete');
        });

        Route::namespace('Admin')->prefix('admin')->group(function () {
            Route::get('/', 'HomeController@index')->name('admin.index');

            Route::get('/menu', 'MenuController@index')->name('admin.menu.index');
            Route::get('/menu/create', 'MenuController@create')->name('admin.menu.create');
            Route::post('/menu/store', 'MenuController@store')->name('admin.menu.store');
            Route::put('/menu/update/{id}', 'MenuController@update')->name('admin.menu.update');
            Route::get('/menu/edit/{id}', 'MenuController@edit')->name('admin.menu.edit');
            Route::get('/menu/delete/{id}', 'MenuController@destroy')->name('admin.menu.delete');

            Route::get('/transaction', 'TransactionController@index')->name('admin.transaction.index');
        });
    });
});