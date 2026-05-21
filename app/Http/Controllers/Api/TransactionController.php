<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $transaction = [
            [

                "invoice" => "INV001",
                "customer" => "Andi",
                "total" => 500000
            ]

        ];
        return response()->json($transaction);
    }

    public function summary()
    {
        $transactions = [
            [
                'id' => 1,
                'customer' => 'Budi',
                'amount' => 150000
            ],
            [
                'id' => 2,
                'customer' => 'Ayu',
                'amount' => 200000
            ],
            [
                'id' => 3,
                'customer' => 'Made',
                'amount' => 50000
            ],
            [
                'id' => 4,
                'customer' => 'Budi',
                'amount' => 100000
            ],
        ];


        $totalTransaksi = count($transactions);

        $totalNominal = 0;
        foreach ($transactions as $transaction) {
            $totalNominal += $transaction['amount'];
        }


        $rataRata = $totalTransaksi > 0 ? $totalNominal / $totalTransaksi : 0;


        return response()->json([
            'total_transaksi' => $totalTransaksi,
            'total_nominal_transaksi' => $totalNominal,
            'rata_rata_transaksi' => $rataRata
        ]);
    }

    public function getReport($year, $month)
    {

        $reports = [
            [
                'id' => 1,
                'date' => '2025-10-05',
                'amount' => 150000
            ],
            [
                'id' => 2,
                'date' => '2025-10-15',
                'amount' => 200000
            ],
            [
                'id' => 3,
                'date' => '2025-11-01',
                'amount' => 50000
            ],
        ];


        $filteredReports = [];


        $requestBulan = str_pad($month, 2, '0', STR_PAD_LEFT);
        $targetTahunBulan = $year . '-' . $requestBulan;

        foreach ($reports as $report) {
            $reportTahunBulan = substr($report['date'], 0, 7);


            if ($reportTahunBulan == $targetTahunBulan) {
                $filteredReports[] = $report;
            }
        }


        return response()->json([
            'year_requested' => $year,
            'month_requested' => $month,
            'data' => $filteredReports
        ]);
    }

    public function getByCustomer($name)
    {
        $transactions = [
            ['id' => 1, 'customer' => 'Budi', 'amount' => 150000],
            ['id' => 2, 'customer' => 'Ayu', 'amount' => 200000],
            ['id' => 3, 'customer' => 'Made', 'amount' => 50000],
            ['id' => 4, 'customer' => 'Budi', 'amount' => 100000],
        ];

        $filteredTransactions = [];
        foreach ($transactions as $transaction) {
            if (strtolower($transaction['customer']) == strtolower($name)) {
                $filteredTransactions[] = $transaction;
            }
        }

        return response()->json($filteredTransactions);
    }


}
