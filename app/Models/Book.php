<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\BookImage;
use App\Models\BookComment;

class Book extends Model
{
    use HasFactory;

    protected $table = "books";

    protected $fillable = [
        'title',
        'description',
        'price',
        'discount',
        'pdf',
        'category_id',
        'state'
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function bookImages() {
        return $this->hasMany(BookImage::class);
    }

    public function bookComments() {
        return $this->hasMany(BookComment::class);
    }

    public function SaleDetails() {
        return $this->hasMany(SaleDetail::class);
    }
}
