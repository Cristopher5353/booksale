<?php

namespace App\Repositories;
use DB;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Book;
use App\Models\BookImage;
use App\Models\BookComment;

class BookRepository {
    public function getBooks() : Collection {
        return Book::all();
    }

    public function saveBook(Book $book) : void {
        $book->save();
    }

    public function getBookById(int $id) : Book {
        return Book::find($id);
    }

    public function updateBook(Book $book) : void {
        $book->update();
    }
    
    public function getBookReport() : Collection{
        $books = Collection::make(DB::table('books')
                ->join('categories', 'books.category_id', '=', 'categories.id')
                ->select('books.id AS id', 
                        'books.title AS title', 
                        'books.description AS description', 
                        'books.price AS price', 
                        'books.discount AS discount',
                        DB::raw('(books.price - books.discount) AS price_original'),
                        'categories.name AS category',
                        'books.created_at')
                ->get());
        return $books;
    }

    public function getBookReportByCategoryId(int $id) : Collection{
        return  Collection::make(DB::table('books')
                ->join('categories', 'books.category_id', '=', 'categories.id')
                ->select('books.id AS id', 
                        'books.title AS title', 
                        'books.description AS description', 
                        'books.price AS price', 
                        'books.discount AS discount',
                        DB::raw('(books.price - books.discount) AS price_original'),
                        'categories.name AS category',
                        'books.created_at')
                ->where('books.category_id', '=', $id)
                ->get());
    }

    public function getBooksIndex() : Collection {
        return Collection::make(DB::table('books')
                ->join('categories', 'books.category_id', '=', 'categories.id')
                ->leftJoin('book_images', 'books.id', '=', 'book_images.book_id')
                ->select('books.id AS id', 'books.title AS title', 'books.price AS price', 'books.discount AS discount', 
                        'categories.name AS category', DB::raw('GROUP_CONCAT(book_images.image ORDER BY book_images.position ASC) AS images'))
                ->groupBy('books.id')->get());
    }

    public function getBookByIdIndex(int $id) {
        return DB::table('books')
                ->join('categories', 'books.category_id', '=', 'categories.id')
                ->leftJoin('book_images', 'books.id', '=', 'book_images.book_id')
                ->where('books.id', '=', $id)
                ->select('books.id AS id', 'books.title AS title', 'books.description AS description', 'books.price AS price', 'books.discount AS discount', 
                        'categories.name AS category', DB::raw('GROUP_CONCAT(book_images.image ORDER BY book_images.position ASC) AS images'))
                ->groupBy('books.id')->first();
    }

    public function getBookByIdLimitIndex(int $id) {
        return  DB::table('books')
                ->select('books.id AS id', 'books.title AS title', 'books.description AS description', 
                        DB::raw('(books.price - books.discount) AS price'),
                        DB::raw('(SELECT book_images.image FROM book_images WHERE book_images.book_id = ' . $id . ' ORDER BY book_images.position LIMIT 1) AS image') )
                ->first();
    } 

    public function getBookByIdCart(int $id) {
        return DB::table('books')
                ->join('categories', 'books.category_id', '=', 'categories.id')
                ->leftJoin('book_images', 'books.id', '=', 'book_images.book_id')
                ->select('books.id AS id', 'books.title AS title', 'books.price AS price', 'books.discount AS discount', 
                        'categories.name AS category', DB::raw('GROUP_CONCAT(book_images.image ORDER BY book_images.position ASC) AS images'))
                ->where('books.id', '=', $id)
                ->groupBy('books.id')->get()[0];
    }

    public function fiveBestBooks() {
        return DB::table('sale_details')
                ->join('books', 'sale_details.book_id', '=', 'books.id')
                ->select('books.title', DB::raw('COUNT(sale_details.book_id) AS quantity'))
                ->groupBy('books.title')
                ->orderBy('quantity')->get();
    }
}