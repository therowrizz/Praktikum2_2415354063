<?php
// namespace App\Http\Controllers\Api;
// use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
// class ProductController extends Controller
// {
//     public function index()
//     {
//         $products = [
//             [
//                 'id' => 1,
//                 'name' => 'Laptop',
//                 'stock' => 20,
//                 'price' => 12000000
//             ],
//             [
//                 'id' => 2,
//                 'name' => 'Keyboard',
//                 'stock' => 15,
//                 'price' => 350000
//             ]
//         ];
//         return response()->json($products);
//     }


// }


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;


class ProductController extends Controller
{

    public function show(string $id)
    {

        $products = [
            [
                'id' => 1,
                'name' => 'Laptop',
                'price' => 12000000,
                'stock' => 10
            ],
            [
                'id' => 2,
                'name' => 'Mouse',
                'price' => 150000,
                'stock' => 40
            ],
            [
                'id' => 3,
                'name' => 'Keyboard',
                'price' => 350000,
                'stock' => 15
            ]
        ];


        $productDetail = null;

        foreach ($products as $product) {
            if ($product['id'] == $id) {
                $productDetail = $product;
                break;
            }
        }


        if ($productDetail) {
            return response()->json($productDetail);
        } else {

            return response()->json(['message' => 'Product not found'], 404);
        }
    }

    public function search(Request $request)
    {
        $keyword = strtolower($request->name);

        $products = [
            [
                'id' => 1,
                'name' => 'Laptop',
                'price' => 12000000,
                'stock' => 10
            ],
            [
                'id' => 2,
                'name' => 'Mouse',
                'price' => 150000,
                'stock' => 40
            ],
            [
                'id' => 3,
                'name' => 'Keyboard',
                'price' => 350000,
                'stock' => 15
            ]
        ];


        $hasilPencarian = [];


        foreach ($products as $product) {
            if (strtolower($product['name']) == $keyword) {
                $hasilPencarian[] = $product;
            }
        }

        return response()->json($hasilPencarian);
    }

    public function filterStock(Request $request)
    {

        $minStock = $request->stock;

        $products = [
            [
                'id' => 1,
                'name' => 'Laptop',
                'price' => 12000000,
                'stock' => 10
            ],
            [
                'id' => 2,
                'name' => 'Mouse',
                'price' => 150000,
                'stock' => 40
            ],
            [
                'id' => 3,
                'name' => 'Keyboard',
                'price' => 350000,
                'stock' => 15
            ]
        ];

        $filteredProducts = [];
        foreach ($products as $product) {
            if ($product['stock'] > $minStock) {
                $filteredProducts[] = $product;
            }
        }

        return response()->json($filteredProducts);
    }

    public function getByCity($city)
    {
        $customers = [
            [
                'id' => 1,
                'name' => 'Baron',
                'city' => 'Denpasar'
            ],
            [
                'id' => 2,
                'name' => 'Badut',
                'city' => 'Bandung'
            ]
        ];

        $result = [];
        foreach ($customers as $customer) {
            if (strtolower($customer['city']) == strtolower($city)) {
                $result[] = $customer;
            }
        }

        return response()->json($result);
    }

    public function getByCategory(Request $request, $category)
    {
        $minPrice = $request->query('min_price', 0);

        $products = [
            [
                'id' => 1,
                'name' => 'Laptop',
                'price' => 12000000,
                'stock' => 10,
                'category' => 'electronic'
            ],
            [
                'id' => 2,
                'name' => 'Mouse',
                'price' => 150000,
                'stock' => 40,
                'category' => 'electronic'
            ],
            [
                'id' => 3,
                'name' => 'Keyboard',
                'price' => 350000,
                'stock' => 15,
                'category' => 'electronic'
            ],
            [
                'id' => 4,
                'name' => 'Meja Kerja',
                'price' => 450000,
                'stock' => 5,
                'category' => 'furniture'
            ]
        ];

        $filteredProducts = [];
        foreach ($products as $product) {
            $matchCategory = strtolower($product['category']) == strtolower($category);
            $matchPrice = $product['price'] >= $minPrice;

            if ($matchCategory && $matchPrice) {
                $filteredProducts[] = $product;
            }
        }
        return response()->json($filteredProducts);
    }

    public function maxPrice()
    {
        $products = [
            ['id' => 1, 'name' => 'Laptop', 'price' => 12000000, 'stock' => 10],
            ['id' => 2, 'name' => 'Mouse', 'price' => 150000, 'stock' => 40],
            ['id' => 3, 'name' => 'Keyboard', 'price' => 350000, 'stock' => 15]
        ];

        $maxProduct = null;

        foreach ($products as $product) {
            if ($maxProduct === null || $product['price'] > $maxProduct['price']) {
                $maxProduct = $product;
            }
        }

        return response()->json($maxProduct);
    }

    public function minStock()
    {
        $products = [
            ['id' => 1, 'name' => 'Laptop', 'price' => 12000000, 'stock' => 10],
            ['id' => 2, 'name' => 'Mouse', 'price' => 150000, 'stock' => 40],
            ['id' => 3, 'name' => 'Keyboard', 'price' => 350000, 'stock' => 15]
        ];

        $minProduct = null;

        foreach ($products as $product) {
            if ($minProduct === null || $product['stock'] < $minProduct['stock']) {
                $minProduct = $product;
            }
        }

        return response()->json($minProduct);
    }

}