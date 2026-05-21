<!DOCTYPE html>
<html>
<head>
 <title>ERP Dashboard</title>
</head>
<body>
 <h1>ERP Starter Dashboard</h1>
 <h2>Daftar Produk</h2>
 <ul>
 @foreach($products as $product)
 <li>
 {{ $product['name'] }} - Stock: {{ $product['stock'] }}
 </li>
 @endforeach
 </ul>

 <h2>Daftar Transaksi</h2>
 <ul>
 @foreach($transactions as $transaction)
 <li>
 Invoice: {{ $transaction['invoice'] }} - Customer: {{ $transaction['customer'] }} - Total: {{ $transaction['total'] }}
 </li>
 @endforeach
 </ul>

 <h2>Daftar Customer   </h2>
 <ul>
 @foreach($customers as $customer)
 <li>
 Name: {{ $customer['name'] }} - City: {{ $customer['city'] }}
 </li>
 @endforeach
 </ul>
 </ul>
</body>
</html>