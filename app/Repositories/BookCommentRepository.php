<?php

namespace App\Repositories;
use DB;
use Illuminate\Database\Eloquent\Collection;
use App\Models\BookComment;

class BookCommentRepository {
    public function getBookComments() : Collection {
        return BookComment::all();
    }

    public function getBookCommentById(int $id) : BookComment{
        return BookComment::find($id);
    }

    public function updateBookComment(BookComment $bookComment) : void {
        $bookComment->update();
    }
    
    public function getBookCommentsByBook(int $id) : Collection {
        return Collection::make(DB::table('book_comments')
                ->where('book_id', '=', $id)
                ->where('state', '=', '1')
                ->get()); 
    }

    public function saveBookCommment(BookComment $bookComment) : void {
        $bookComment->save();
    }
}