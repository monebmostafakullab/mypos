<?php


use Illuminate\Support\Facades\Route;

Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]],
    function() {
        Route::prefix('admin')->name('admin.')->group(function (){

            // Dashboard Controller
            Route::get('/','DashboardController@index')->name('index');
            Route::get('/index','DashboardController@index')->name('index');

        });//end of Admins routs
});//end localization



