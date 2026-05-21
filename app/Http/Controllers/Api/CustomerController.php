<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = [
            [
                'id' => 1,
                'name' => 'Andi',
                'city' => 'Denpasar'
            ],
            [
                'id' => 2,
                'name' => 'Sinta',
                'city' => 'Bandung'
            ]
        ];
        return response()->json($customers);
    }

    public function searchByCity(Request $request)
    {
        $cityQuery = strtolower($request->city);

        $customers = [
            ['id' => 1, 'name' => 'Budi', 'city' => 'Jakarta'],
            ['id' => 2, 'name' => 'Ayu', 'city' => 'Denpasar'],
            ['id' => 3, 'name' => 'Made', 'city' => 'Denpasar'],
            ['id' => 4, 'name' => 'Siti', 'city' => 'Surabaya']
        ];

        $filteredCustomers = [];
        foreach ($customers as $customer) {
            if (strtolower($customer['city']) == $cityQuery) {
                $filteredCustomers[] = $customer;
            }
        }

        return response()->json($filteredCustomers);
    }

}