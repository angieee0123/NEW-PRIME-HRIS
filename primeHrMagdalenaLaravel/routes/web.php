<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function(){
    return view('about');
})->name('about');



Route::get('/signup', function(){
    return view('login');
})->name('login');


