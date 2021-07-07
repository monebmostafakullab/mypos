<?php


use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]],
    function() {
        Route::prefix('admin')->name('admin.')->group(function (){

            // login Controller without middlware
            Route::get('login', 'LoginController@login')->name('login');
            Route::post('login', 'LoginController@getlogin')->name('getlogin');


            Route::middleware('auth:admin')->group(function (){

                //login Controller
                Route::post('logout', 'LoginController@logout')->name('logout');

                // Dashboard Controller
                Route::get('/','DashboardController@index')->name('index');
                Route::get('/index','DashboardController@index')->name('index');

                // Admins Controller
                Route::resource('admins','AdminController')->except('show');
            });
        });//end of Admins routs
});//end localization



