<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\doctorcontroller;


Route::get('/user', [doctorcontroller::class, 'form']);
Route::post('/new', [doctorcontroller::class, 'dept']);
Route::get('/edit/{id}', [doctorcontroller::class, 'editDept']);
Route::post('/useredit/{id}',[doctorcontroller::class, 'editUser']);


Route::post('/register', [doctorcontroller::class, 'addUser']);
Route::post('/login', [doctorcontroller::class, 'login']);
Route::get('/delete/{id}', [doctorcontroller::class, 'deptdelete']);