<?php

use Illuminate\Support\Facades\Route;


Route::view('/{any}', 'layout.app')
    ->where('any', '^(?!api).*$');

