<?php

// use App\Http\Controllers\Api\TransactionController;
// use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\Api\ProductController;
// use App\Http\Controllers\Api\CustomerController;

// Route::get('/products', [ProductController::class, 'index']);
// Route::get('/customers', [CustomerController::class, 'index']);
// Route::get('/transactions', [TransactionController::class, 'index']);


use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\TransactionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController; // Jangan lupa import controllernya

// Route untuk search (Bagian B) ditaruh LEBIH ATAS
Route::get('/products/search', [ProductController::class, 'search']);

// Route untuk filter berdasarkan stok (Bagian C)
Route::get('/products/filter-stock', [ProductController::class, 'filterStock']);

// Route untuk filter berdasarkan kategori + min_price (Bagian C SC5)
Route::get('/customers/city/{city}', [CustomerController::class, 'getByCity']);

Route::get('/transactions/summary', [TransactionController::class, 'summary']);

Route::get('/report/{year}/{month}', [TransactionController::class, 'getReport']);

// --- ROUTE PRODUCT ---
Route::get('/products/category/{category}', [ProductController::class, 'getByCategory']);

Route::get('/products/max-price', [ProductController::class, 'maxPrice']);

Route::get('/products/min-stock', [ProductController::class, 'minStock']);

Route::get('/customers/search', [CustomerController::class, 'searchByCity']);

Route::get('/customers/search', [CustomerController::class, 'searchByCity']);

// Route untuk show by ID (Bagian A) ditaruh DI BAWAHNYA
Route::get('/products/{id}', [ProductController::class, 'show']);

