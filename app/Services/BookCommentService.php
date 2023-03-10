<?php

namespace App\Services;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use App\Models\BookComment;
use App\Repositories\BookCommentRepository;

class BookCommentService {
    protected $bookCommentRepository;

    public function __construct(BookCommentRepository $bookCommentRepository) {
        $this->bookCommentRepository = $bookCommentRepository;
    }

    public function getBookComments() : Collection {
        return $this->bookCommentRepository->getBookComments();
    }
    
    public function updateBookComment(BookComment $bookComment) : void {
        $this->bookCommentRepository->updateBookComment($bookComment);
    }

    public function changeStateBookComment(int $id) : void {
        $comment = $this->bookCommentRepository->getBookCommentById($id);
        $comment->state = ($comment->state == 1) ?0 :1;

        $this->bookCommentRepository->updateBookComment($comment);
    }

    public function getBookCommentsByBook(int $id) : Collection {
        return $this->bookCommentRepository->getBookCommentsByBook($id);
    }

    public function saveBookCommment(Request $request) {
        $validated = $request->validate([
            'comment' =>'required|max:255',
            'stars' => 'required',
        ]);

        $bookComment = new BookComment();
        $bookComment->stars = $request->stars;
        $bookComment->comment = $request->comment;
        $bookComment->book_id = $request->libro;
        $bookComment->state = 0;

        $this->bookCommentRepository->saveBookCommment($bookComment);
    }
}