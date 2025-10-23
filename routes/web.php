<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers;

Route::get('/', [Controllers\HomeController::class, 'index'])->name('home');
Route::controller(Controllers\CompanyController::class)->group(function () {
    Route::get('/about', 'about')->name('about');
    Route::get('/contacts', 'contacts')->name('contacts');
});

Route::controller(Controllers\BlogController::class)->group(function () {
    Route::get('/blog', 'index')->name('blog.index');
    Route::get('/blog/{post}', 'post')->name('blog.post');
});

Route::post('/api/forms', [Controllers\FormsController::class, 'store'])->name('forms');

Route::get('/test', [Controllers\TestController::class, 'index'])->name('test');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
