<?php

Route::group(
    ['middleware' => 'web'],
    function () {
        Route::post('laravel-image}', 'Monurakkaya\LaravelImage\Controllers\ImageController@upload')
            ->name('laravel-image::upload');

        Route::delete('laravel-image/{image}', 'Monurakkaya\LaravelImage\Controllers\ImageController@destroy')
            ->name('laravel-image::destroy');

        Route::get('laravel-image/{image}', 'Monurakkaya\LaravelImage\Controllers\ImageController@makeDefault')
            ->name('laravel-image::makeDefault');
    }
);
