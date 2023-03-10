<?php

namespace App\Repositories;

use DB;
use App\Models\Sale;

class SaleRepository {
    public function saveSale(Sale $sale) { 
        $sale->save();
    }

    public function getSales() {
        return DB::table('sales')
                ->join('users', 'sales.user_id', '=', 'users.id')
                ->select('sales.id AS id', DB::raw('CONCAT(users.name, " ", users.surname) AS user'), 'sales.total AS total', 'sales.created_at AS fecha')
                ->get();
    }

    public function getSalesBetweenDates(array $dates) {
        return DB::table('sales')
                     ->join('users', 'sales.user_id', '=', 'users.id')
                     ->select('sales.id AS id', DB::raw('CONCAT(users.name, " ", users.surname) AS user'), 'sales.total AS total', 'sales.created_at AS fecha')
                     ->whereBetween('sales.created_at', [$dates[0], $dates[1]])
                     ->get();
    }

    public function getSaleById(int $saleId) {
        return DB::table('sales')
                ->join('users', 'sales.user_id', '=', 'users.id')
                ->select(DB::raw('CONCAT(users.name, " ", users.surname) AS user'), 'users.dni AS dni', 'users.phone AS phone', 'sales.total AS total', 'sales.created_at AS fecha')
                ->where('sales.id', '=', $saleId)
                ->first();
    }

    public function totalSales() {
        return DB::table('sale_details')
                ->sum("subtotal");
    }

    public function totalSalesToday() {
        return DB::table('sale_details')
                ->where(DB::raw('DATE(created_at)'), '=', DB::raw('CURDATE()'))
                ->sum('subtotal');
    }

    public function getSalesPerMonth() {
        return DB::table('sales')
                ->select(DB::raw('MONTH(created_at) AS month'), DB::raw('SUM(total) AS total'))
                ->groupBy('month')
                ->get();
    }
}