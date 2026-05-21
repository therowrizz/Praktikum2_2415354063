<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\TransactionController;
class DashboardController extends Controller
{
    public function index(TransactionController $transactionController, CustomerController $customerController, ProductController $productController)
    {
        $transactions = $transactionController->index()->getData(true);
        $customers = $customerController->index()->getData(true);
        $products = $productController->index()->getData(true);
        return view('dashboard', compact('transactions', 'customers', 'products'));
    }
}