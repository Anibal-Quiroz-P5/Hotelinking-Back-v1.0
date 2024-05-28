<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

// Route::get('/posts/{post}', function($post){
//     return "Aqui voy amostrar el post {$post}";
// });

Route::get('/user', function (Request $request) {
    return $request->user(); 
});

require __DIR__.'/auth.php';


