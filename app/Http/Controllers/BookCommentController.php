<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BookCommentService;

class BookCommentController extends Controller
{
    protected $bookCommentService;

    public function __construct(BookCommentService $bookCommentService) {
        $this->bookCommentService = $bookCommentService;
    }

    public function getBookComments() {
        $bookComments = $this->bookCommentService->getBookComments();
        return view("books.bookComments", compact("bookComments"));
    }

    public function changeStateBookComment(Request $request) {
        $this->bookCommentService->changeStateBookComment($request->id);
        return redirect()->route("getBookComments")->with(["message" => "Estado de comentario actualizado correctamente"]);
    }
}
