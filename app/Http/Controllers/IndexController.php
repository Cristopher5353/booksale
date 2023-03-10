<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Publication;
use App\Models\Store;
use App\Models\Product;
use App\Models\BookComment;
use Illuminate\Support\Facades\DB;
use App\Services\BookService;
use App\Services\PublicationService;
use App\Services\StoreService;
use App\Services\BookCommentService;

class IndexController extends Controller
{
    protected $bookService;
    protected $publicationService;
    protected $storeService;
    protected $bookCommentService;

    public function __construct(BookService $bookService, PublicationService $publicationService, StoreService $storeService, BookCommentService $bookCommentService) {
        $this->bookService = $bookService;
        $this->publicationService = $publicationService;
        $this->storeService = $storeService;
        $this->bookCommentService = $bookCommentService;
    }

    public function index() {
        $books = $this->bookService->getBooksIndex();
        $publications = $this->publicationService->getPublications();
        $stores = $this->storeService->getStores();

        return view("index", compact("books", "publications", "stores"));
    }

    public function getPublicationById(Request $request) {
        $publication = $this->publicationService->getPublicationById($request->id);

        if($request->ajax()) {
            return response()->json([
                "publication" => $publication
            ]);
        }
    }

    public function getBookById(Request $request) {
        $product = $this->bookService->getBookByIdIndex($request);

        if($request->ajax()) {
            return response()->json([
                "product" => $product
            ]);
        }
    }

    public function bookComments(Request $request) {
        $bookId = $request->libro;
        $book = $this->bookService->getBookByIdLimitIndex($bookId);
        $bookComments = $this->bookCommentService->getBookCommentsByBook($bookId);

        return view("comments.index", compact("bookId", "book", "bookComments"));
    }

    public function bookComment(Request $request) {
        $this->bookCommentService->saveBookCommment($request);
        return redirect()->route("bookComments", $request->libro)->with(["message" => "Comentario enviado correctamente"]);
    }
}
