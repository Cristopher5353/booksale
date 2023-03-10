<?php

namespace App\Repositories;
use Illuminate\Database\Eloquent\Collection;
use App\Models\BookImage;
use App\Models\Book;

class BookImageRepository {
    public function saveBookImage(BookImage $bookImage) : void {
        $bookImage->save();
    }

    public function getBookImagesByBook(Book $book) : Collection {
        return $book->bookImages->sortBy("position");
    }

    public function getBookImageById(int $id) : BookImage {
        return BookImage::find($id);
    }

    public function deleteBookImage(BookImage $bookImage) : void {
        $bookImage->delete();
    }

    public function updateBookImage(BookImage $bookImage) : void{
        $bookImage->update();
    }
}