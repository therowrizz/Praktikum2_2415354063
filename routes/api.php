<?php

use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\TransactionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;


Route::get('/products/search', [ProductController::class, 'search']);

Route::get('/products/filter-stock', [ProductController::class, 'filterStock']);

Route::get('/customers/city/{city}', [CustomerController::class, 'getByCity']);

Route::get('/transactions/summary', [TransactionController::class, 'summary']);

Route::get('/report/{year}/{month}', [TransactionController::class, 'getReport']);

Route::get('/products/category/{category}', [ProductController::class, 'getByCategory']);

Route::get('/products/max-price', [ProductController::class, 'maxPrice']);

Route::get('/products/min-stock', [ProductController::class, 'minStock']);

Route::get('/customers/search', [CustomerController::class, 'searchByCity']);

Route::get('/transactions/customer/{name}', [TransactionController::class, 'getByCustomer']);

Route::get('/products/{id}', [ProductController::class, 'show']);

