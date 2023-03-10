<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BookImageService;
use App\Services\BookService;

class BookImageController extends Controller
{
    protected $bookImageService;
    protected $bookService;

    public function __construct(BookImageService $bookImageService, BookService $bookService) {
        $this->bookImageService = $bookImageService;
        $this->bookService = $bookService;
    }

    public function getBookImagesByBook(int $id) {
        $book = $this->bookService->getBookById($id);
        $images = $this->bookImageService->getBookImagesByBook($book);

        return view("books.bookImages", compact("book", "images"));
    }

    public function deleteBookImage(int $bookId, int $bookImageId) {
        $bookImage = $this->bookImageService->getBookImageById($bookImageId);
        $this->bookImageService->deleteBookImage($bookImage);

        return redirect()->route("getBookImagesById", $bookId)->with(["message" => "Imagen de libro eliminada correctamente"]);
    }

    public function updateBookImages(Request $request, int $id) {
        $response = $this->bookImageService->updateBookImages($request, $id);
        return redirect()->route($response["route"], $id)->with([$response["key"] => $response["value"]]);
    }

    public function changePositionBookImages(Request $request) {
        $this->bookImageService->changePositionBookImages($request);
    }
}
