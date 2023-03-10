<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Repositories\BookImageRepository;
use App\Repositories\BookRepository;
use App\Models\Book;
use App\Models\BookImage;

class BookImageService {
    protected $bookImageRepository;
    protected $bookRepository;

    public function __construct(BookImageRepository $bookImageRepository, BookRepository $bookRepository) {
        $this->bookImageRepository = $bookImageRepository;
        $this->bookRepository = $bookRepository;
    }

    public function getBookImagesByBook(Book $book) : Collection {
       return $this->bookImageRepository->getBookImagesByBook($book);
    }

    public function getBookImageById(int $id) : BookImage {
        return $this->bookImageRepository->getBookImageById($id);
    }

    public function deleteBookImage(BookImage $bookImage) : void {
        $this->bookImageRepository->deleteBookImage($bookImage);
        
        $imagePath = public_path("images/books/".$bookImage->image);
        unlink($imagePath);
    }

    public function updateBookImages(Request $request, int $id) : array {
        $validated = $request->validate([
            'photos.*' => 'file|mimes:png,jpge,jpg'
        ]);

        if($request->file("photos")) {
            $numberBookImagesRequest = count($request->file("photos"));
            $numberBookImagesCurrent = count(Book::find($id)->bookImages);

            if(($numberBookImagesCurrent == 4) || ($numberBookImagesCurrent + $numberBookImagesRequest) > 4) {
                return ["route" => "getBookImagesById", "key" => "messageError", "confirm" => 0, "value" => "Solo se aceptan 4 imágenes por libro"];
            }

            $count = 1;
            
            foreach($request->file("photos") as $photo) {
                $nameImage = "book_".time().$photo->getClientOriginalName();
                $bookImage = new BookImage();
                $bookImage->image = $nameImage;
                $bookImage->book_id = $id;

                if($this->bookRepository->getBookById($id)->bookImages->sortByDesc("position")->first() == null) {
                    $bookImage->position = $count;
                    $count++;

                } else {
                    $bookImage->position = $this->bookRepository->getBookById($id)->bookImages->sortByDesc("position")->first()->position + 1;
                }
                
                $this->bookImageRepository->saveBookImage($bookImage);

                $newRoute = public_path("images/books/".$nameImage);
                copy($photo->getRealPath(), $newRoute);
            }

            return ["route" => "getBookImagesById", "key" => "message", "confirm" => 1, "value" => "Imágenes agregadas correctamente"];
        }

        return ["route" => "getBookImagesById", "key" => "messageError", "confirm" => 0, "value" => "No has ingresado ninguna imagen"];
    }

    public function changePositionBookImages(Request $request) : void {
        $position = 1;
        $sortItems = $request->get("sorts");

        foreach($sortItems as $sort) {
            $image = $this->bookImageRepository->getBookImageById($sort);
            $image->position = $position;
            $this->bookImageRepository->updateBookImage($image);
            
            $position++;
        }
    }
}