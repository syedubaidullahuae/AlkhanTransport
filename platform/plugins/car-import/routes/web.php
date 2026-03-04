<?php

use Botble\Base\Facades\AdminHelper;
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Botble\CarImport\Http\Controllers'], function (): void {

    AdminHelper::registerRoutes(function (): void {

        Route::group(['prefix' => 'car-import', 'as' => 'import.'], function (): void {

            Route::resource('', 'CarImportController')->parameters(['' => 'import']);

        });

    });

});