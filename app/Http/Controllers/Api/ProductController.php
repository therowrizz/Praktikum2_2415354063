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

// namespace App\Http\Controllers\Api;

// use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;

// class ProductController extends Controller
// {
//     // Pindahkan $products jadi property class (bukan di dalam method)
//     private array $products = [
//         ['id' => 1, 'name' => 'Laptop', 'price' => 12000000, 'stock' => 10, 'category' => 'electronic'],
//         ['id' => 2, 'name' => 'Mouse', 'price' => 150000, 'stock' => 40, 'category' => 'electronic'],
//         ['id' => 3, 'name' => 'Keyboard', 'price' => 350000, 'stock' => 15, 'category' => 'electronic'],
//     ];

//     // Bagian A — tampilkan semua produk
//     public function index()
//     {
//         return response()->json($this->products);
//     }

//     // Bagian A — cari by ID
//     public function show(string $id)
//     {
//         foreach ($this->products as $product) {
//             if ($product['id'] == $id) {
//                 return response()->json($product);
//             }
//         }
//         return response()->json(['message' => 'Product not found'], 404);
//     }

//     // Bagian B — search by name
//     public function search(Request $request)
//     {
//         $keyword = strtolower($request->name ?? '');
//         $result = [];

//         foreach ($this->products as $product) {
//             if (str_contains(strtolower($product['name']), $keyword)) {
//                 $result[] = $product;
//             }
//         }

//         return response()->json($result);
//     }

//     // Bagian C SC1 — filter by stock
//     public function filterStock(Request $request)
//     {
//         $minStock = (int) ($request->stock ?? 0);
//         $result = array_filter($this->products, fn($p) => $p['stock'] > $minStock);
//         return response()->json(array_values($result));
//     }

//     // Bagian C SC5 — filter by category + min_price
//     public function byCategory(Request $request, string $category)
//     {
//         $minPrice = (int) ($request->min_price ?? 0);
//         $result = array_filter(
//             $this->products,
//             fn($p) =>
//             strtolower($p['category']) === strtolower($category)
//             && $p['price'] >= $minPrice
//         );
//         return response()->json(array_values($result));
//     }

//     // Tugas Tambahan 1 — max price
//     public function maxPrice()
//     {
//         $max = $this->products[0];
//         foreach ($this->products as $p) {
//             if ($p['price'] > $max['price'])
//                 $max = $p;
//         }
//         return response()->json($max);
//     }

//     // Tugas Tambahan 2 — min stock
//     public function minStock()
//     {
//         $min = $this->products[0];
//         foreach ($this->products as $p) {
//             if ($p['stock'] < $min['stock'])
//                 $min = $p;
//         }
//         return response()->json($min);
//     }
// }



namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;


class ProductController extends Controller
{
    // 2. Membuat Method show()
    public function show(string $id)
    {
        // 3. Membuat Array Products
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

        // 4. Cari Product Berdasarkan ID menggunakan perulangan
        $productDetail = null;

        foreach ($products as $product) {
            if ($product['id'] == $id) {
                $productDetail = $product;
                break; // Hentikan pencarian kalau ID sudah ketemu
            }
        }

        // 5. Return JSON
        if ($productDetail) {
            return response()->json($productDetail);
        } else {
            // Optional: Response jika ID tidak ditemukan
            return response()->json(['message' => 'Product not found'], 404);
        }
    }

    public function search(Request $request)
    {
        $keyword = strtolower($request->name);

        // 2. Data array products statis (sama seperti di method show)
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

        // 3. Siapkan array kosong untuk menampung hasil yang cocok
        $hasilPencarian = [];

        // 4. Cari product berdasarkan nama
        foreach ($products as $product) {
            // Pastikan nama product juga di-lowercase agar perbandingan sesuai
            if (strtolower($product['name']) == $keyword) {
                $hasilPencarian[] = $product;
            }
        }

        // 5. Return JSON hasil pencarian
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
        // 1. Ambil nilai query parameter 'min_price' (default 0 jika tidak diisi)
        $minPrice = $request->query('min_price', 0);

        // 2. Data dummy dengan tambahan field 'category'
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

        // 3. Filter berdasarkan category DAN min_price
        $filteredProducts = [];
        foreach ($products as $product) {
            // Cek apakah kategorinya cocok (tidak case sensitive)
            $matchCategory = strtolower($product['category']) == strtolower($category);
            // Cek apakah harganya lebih besar atau sama dengan min_price
            $matchPrice = $product['price'] >= $minPrice;

            if ($matchCategory && $matchPrice) {
                $filteredProducts[] = $product;
            }
        }

        // 4. Return hasil filter dalam bentuk JSON
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
            // Jika $maxProduct masih kosong, atau harga product ini lebih mahal dari yang tersimpan
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
            // Jika $minProduct masih kosong, atau stock product ini lebih sedikit dari yang tersimpan
            if ($minProduct === null || $product['stock'] < $minProduct['stock']) {
                $minProduct = $product;
            }
        }

        return response()->json($minProduct);
    }

}