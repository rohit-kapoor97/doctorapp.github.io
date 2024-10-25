<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\doctorcontroller;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\newusermiddleware;



Route::middleware(newusermiddleware::class)->group(function(){
Route::get('/',[doctorcontroller::class, 'index'])->name('index.view');


});

Route::post('/appointment', [doctorcontroller::class,'book'])->name('book.app');
Route::get('/user',[doctorcontroller::class, 'register'])->name('register.view');
Route::get('/no',[doctorcontroller::class, 'countrycode']);
Route::get('/otp',[doctorcontroller::class, 'otpverfiy'])->name('otp.view');
Route::post('/otp/verfiy',[doctorcontroller::class, 'verifyotp'])->name('otp.ver');

Route::post('/otp/resend', [doctorcontroller::class, 'resendotp'])->name('otp.resend');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



// Admin Panel
Route::get('/admin',[doctorcontroller::class,'dashview'])->name('admin.view')->Middleware('can:is_admin');
Route::get('/button',[doctorcontroller::class,'buttonview'])->name('button.view');
Route::get('/form',[doctorcontroller::class,'formview'])->name('form.view');
Route::post('/doc/dept', [doctorcontroller::class, 'dept'])->name('dept.add');
Route::get('/dept/{id}', [doctorcontroller::class, 'deptedit'])->name('dept.edit');
Route::post('/edit/{id}', [doctorcontroller::class, 'edit'])->name('edit.dept');

Route::get('/delete/{id}', [doctorcontroller::class, 'deleteuser'])->name('dept.delete');

Route::get('/card',[doctorcontroller::class,'cardview'])->name('card.view');
Route::get('/chart',[doctorcontroller::class,'chartview'])->name('chart.view');
Route::get('/modal',[doctorcontroller::class,'modalview'])->name('modal.view');
Route::get('/table',[doctorcontroller::class,'tableview'])->name('table.view');

// creat account or login

Route::get('/admin/register', [doctorcontroller::class, 'accountview'])->name('acc.view');
Route::get('/admin/login', [doctorcontroller::class, 'loginview'])->name('login.view');
Route::get('/admin/password', [doctorcontroller::class, 'forgetview'])->name('forgot.view');

// search

// Route::get('/search', [doctorcontroller::class, 'search'])->name('search.view');
Route::get('/search/dept', [doctorcontroller::class, 'searchdep'])->name('search.dept');




require __DIR__.'/auth.php';
