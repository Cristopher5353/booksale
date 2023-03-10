<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Sale;
use App\Models\Book;

class SaleDetail extends Model
{
    use HasFactory;

    protected $table = "sale_details";

    protected $fillable = [
        'sale_id',
        'book_id',
        'quantity',
        'subtotal'
    ];

    public function sale() {
        return $this->belongsTo(Sale::class);
    }

    public function book() {
        return $this->belongsTo(Book::class);
    }
}
