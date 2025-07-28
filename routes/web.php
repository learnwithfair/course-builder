<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Home and Dashboard
Route::get( '/', function () {
    return redirect()->route( 'dashboard' );
} )->middleware( 'auth' )->name( 'home' );

Route::get( '/dashboard', fn() => view( 'dashboard' ) )->middleware( ['auth', 'verified'] )->name( 'dashboard' );

// Authentication Routes ------------------------------------------------
Route::get( '/login', [LoginController::class, 'showLoginForm'] )->name( 'login' );
Route::post( '/login', [LoginController::class, 'login'] );
Route::post( '/logout', [LoginController::class, 'logout'] )->name( 'logout' );

// Profile Routes (Authenticated Users) ------------------------------------------------
Route::middleware( 'auth' )->group( function () {
    Route::get( '/profile', [ProfileController::class, 'edit'] )->name( 'profile.edit' );
    Route::patch( '/profile', [ProfileController::class, 'update'] )->name( 'profile.update' );
    Route::delete( '/profile', [ProfileController::class, 'destroy'] )->name( 'profile.destroy' );
} );

// Password Reset --------------------------------------------------------
Route::get( '/forgot-password', fn() => view( 'auth.forgot-password' ) )->name( 'password.request' );

// Course Routes -------------------------------------------------------------------------
Route::middleware( 'auth' )->prefix( '/dashboard' )->group( function () {
    Route::get( '/courses', [CourseController::class, 'index'] )->name( 'courses.index' );
    Route::get( '/courses/create', [CourseController::class, 'create'] )->name( 'courses.create' );
    Route::post( '/courses/store', [CourseController::class, 'store'] )->name( 'courses.store' );
    Route::get( '/courses/{course}', [CourseController::class, 'show'] )->name( 'courses.show' );
    Route::delete( '/courses/{course}', [CourseController::class, 'destroy'] )->name( 'courses.destroy' );
} );

require __DIR__ . '/auth.php';