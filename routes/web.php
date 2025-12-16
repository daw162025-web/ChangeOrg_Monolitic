<?php

use App\Http\Controllers\AdminCategoriesController;
use App\Http\Controllers\AdminUsersController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PetitionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminPetitionsController;

Route::get('/', [PagesController::class, 'home'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::controller(PetitionController::class)->group(function () {
    Route::get('petitions/index', 'index')->name('petitions.index');
    Route::get('petitions/{id}', 'show')->name('petitions.show');
    Route::get('mypetitions', 'listMine')->name('petitions.mine')->middleware('auth');
    Route::get('petition/add', 'create')->name('petitions.edit-add')->middleware('auth');
    Route::post('petition', 'store')->name('petitions.store')->middleware('auth');
    Route::post('petitions/sign/{id}', 'sign')->name('petitions.sign')->middleware('auth');
    Route::get('petitionsSigned', 'petitionsSigned')->name('petitions.petitionsSigned');


    Route::get('petitions/edit/{id}', 'edit')->name('petitions.edit')->middleware('auth');
    Route::put('petitions/{id}', 'update')->name('petitions.update')->middleware('auth');
    Route::delete('petitions/{id}', 'destroy')->name('petitions.destroy')->middleware('auth');
});

Route::middleware('admin')->group(function () {
    Route::get('/admin', [AdminPetitionsController::class, 'index'])->name('admin.home');

    Route::controller(AdminPetitionsController::class)->group(function(){
        Route::get('admin/petitions', 'index')->name('admin.petitions.index');
        Route::get('admin/petitions/create', 'create')->name('admin.petitions.create');
        Route::post('admin/petitions', 'store')->name('admin.petitions.store');
        Route::get('admin/petitions/edit/{id}', 'edit')->name('admin.petitions.edit');
        Route::put('admin/petitions/{id}', 'update')->name('admin.petitions.update');
        Route::delete('admin/petitions/{id}', 'delete')->name('admin.petitions.delete');
    });
    Route::controller(AdminCategoriesController::class)->group(function(){
        Route::get('admin/categories', 'index')->name('admin.categories.index');
        Route::get('admin/categories/create', 'create')->name('admin.categories.create');
        Route::post('admin/categories', 'store')->name('admin.categories.store');
        Route::get('admin/categories/edit/{id}', 'edit')->name('admin.categories.edit');
        Route::put('admin/categories/{id}', 'update')->name('admin.categories.update');
        Route::delete('admin/categories/{id}', 'delete')->name('admin.categories.delete');
    });
    Route::controller(AdminUsersController::class)->group(function(){
        Route::get('admin/users', 'index')->name('admin.users.index');
        Route::get('admin/users/edit/{id}', 'edit')->name('admin.users.edit');
        Route::put('admin/users/{id}', 'update')->name('admin.users.update');
        Route::delete('admin/users/{id}', 'delete')->name('admin.users.delete');
    });
});




require __DIR__.'/auth.php';
