<?php

namespace App\Repositories;

use DB;
use App\Models\SaleDetail;

class SaleDetailRepository {
    public function saveSaleDetail(SaleDetail $saleDetail) { 
        $saleDetail->save();
    }

    public function getSaleDetailSBySale(int $saleId) {
        return DB::table('sale_details')
                ->join('books', 'sale_details.book_id', 'books.id')
                ->select('sale_details.quantity AS quantity', 'books.title AS title', 
                        DB::raw('(books.price - books.discount) AS price'), 
                        DB::raw('((books.price - books.discount) * sale_details.quantity) AS subtotal'))
                ->where('sale_details.sale_id', '=', $saleId)
                ->get();
    }
}