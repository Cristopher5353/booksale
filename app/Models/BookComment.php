<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Book;

class BookComment extends Model
{
    use HasFactory;

    protected $table = "book_comments";

    protected $fillable = [
        'stars',
        'comment',
        'book_id',
        'state'
    ];

    public function book() {
        return $this->belongsTo(Book::class);
    }
}
