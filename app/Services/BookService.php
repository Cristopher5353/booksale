<?php

namespace App\Services;

use DB;
use App\Repositories\BookRepository;
use App\Repositories\BookImageRepository;
use App\Repositories\CategoryRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Book;
use App\Models\BookImage;
use App\Models\Category;
use Barryvdh\DomPDF\Facade\Pdf;


class BookService {
    protected $bookRepository;
    protected $bookImageRepository;
    protected $categoryRepository;

    public function __construct(BookRepository $bookRepository, BookImageRepository $bookImageRepository, CategoryRepository $categoryRepository) {
        $this->bookRepository = $bookRepository;
        $this->bookImageRepository = $bookImageRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function getBooks() : Collection {
        return $this->bookRepository->getBooks();
    }

    public function saveBook(Request $request) : array {
        if($request->photos) {
            $validated = $request->validate([
                'title' =>'required|max:255',
                'description' => 'required',
                'price' => 'required|numeric',
                'discount' => 'required|numeric',
                'pdf' => 'required|mimes:pdf',
                'category' => 'required',
                'photos.*' => 'required|file|mimes:png,jpge,jpg'
            ]);

            $numberBookImagesRequest = count($request->file("photos"));

            if($numberBookImagesRequest > 4) {
                return ["route" => "create", "key" => "messageError", "confirm" => 0, "value" => "Solo se aceptan 4 imágenes por libro"];
            }
            
            try {
                DB::beginTransaction();

                $pdf = $request->file("pdf");
                $namePdf = "book_".time().$pdf->getClientOriginalName();
                
                $book = new Book();
                $book->title = $request->title;
                $book->description = $request->description;
                $book->price = $request->price;
                $book->discount = $request->discount;
                $book->pdf = $namePdf;
                $book->category_id = $request->category;
                $book->state = 1;

                $this->bookRepository->saveBook($book);

                $pdf->storeAs('private/documents/books/', $namePdf);

                $count = 1;

                foreach($request->file("photos") as $photo) {
                    $nameImage = "book_".time().$photo->getClientOriginalName();
                    
                    $bookImage = new BookImage();
                    $bookImage->image = $nameImage;
                    $bookImage->book_id = $book->id;
                    $bookImage->position = $count;

                    $this->bookImageRepository->saveBookImage($bookImage);

                    $newRoute = public_path("images/books/".$nameImage);
                    copy($photo->getRealPath(), $newRoute);

                    $count++;
                }

                DB::commit();

            } catch(\Exception $e) {
                DB::rollback();
                return ["route" => "index", "key" => "messageError", "confirm" => 0, "value" => $e->getMessage()];
            }

            return ["route" => "index", "key" => "message", "confirm" => 1, "value" => "Libro agregado correctamente"];

        } else {
            $validated = $request->validate([
                'title' =>'required|max:255',
                'description' => 'required',
                'price' => 'required|numeric',
                'discount' => 'required|numeric',
                'pdf' => 'required|mimes:pdf',
                'category' => 'required'
            ]);

            if($request->hasfile("pdf")) {
                $pdf = $request->file("pdf");
                $namePdf = "book_".time().$pdf->getClientOriginalName();
    
                $pdf->storeAs('private/documents/books/', $namePdf);

                $book = new Book();
                $book->title = $request->title;
                $book->description = $request->description;
                $book->price = $request->price;
                $book->discount = $request->discount;
                $book->pdf = $namePdf;
                $book->category_id = $request->category;
                $book->state = 1;

                $this->bookRepository->saveBook($book);
                return ["route" => "index", "key" => "message", "confirm" => 1, "value" => "Libro agregado correctamente"];
            }
        }
    }

    public function getBookById(int $id) : Book {
        return $this->bookRepository->getBookById($id);
    }

    public function updateBook(Request $request, int $id) : array {
        if($request->pdf) {
            $validated = $request->validate([
                'title' =>'required|max:255',
                'description' => 'required',
                'price' => 'required|numeric',
                'discount' => 'required|numeric',
                'pdf' => 'required|mimes:pdf',
                'category' => 'required'
            ]);

            $pdf = $request->file("pdf");
            $namePdf = "book_".time().".".$pdf->getClientOriginalName();
            $pdf->storeAs('private/documents/books/', $namePdf);

            $book = $this->bookRepository->getBookById($id);

            Storage::delete('private/documents/books/'.$book->pdf);

            $book->title = $request->title;
            $book->description = $request->description;
            $book->price = $request->price;
            $book->discount = $request->discount;
            $book->pdf = $namePdf;
            $book->category_id = $request->category;

            $this->bookRepository->updateBook($book);
            return ["route" => "index", "key" => "message", "confirm" => 1, "value" => "Libro actualizado correctamente"];

        } else {
            $validated = $request->validate([
                'title' =>'required|max:255',
                'description' => 'required',
                'price' => 'required|numeric',
                'discount' => 'required|numeric',
                'category' => 'required'
            ]);

            $book = $this->bookRepository->getBookById($id);
            $book->title = $request->title;
            $book->description = $request->description;
            $book->price = $request->price;
            $book->discount = $request->discount;
            $book->category_id = $request->category;

            $this->bookRepository->updateBook($book);
            return ["route" => "index", "key" => "message", "confirm" => 1, "value" => "Libro actualizado correctamente"];
        }
    }

    public function changeStateBook(int $id) : void {
        $book = $this->bookRepository->getBookById($id);
        $book->state = ($book->state == 1) ?0 :1;

        $this->bookRepository->updateBook($book);
    }

    public function bookReport(Request $request) {
        $boolPdf = $request->pdf;
        $category_id = $request->input('category_id');

        if($category_id == NULL) {
            $books = $this->bookRepository->getBookReport();
        } else {
            $books = $this->bookRepository->getBookReportByCategoryId($category_id);
        }

        $categories = $this->categoryRepository->getCategoriesByStateActive();

        if($boolPdf == "true") {
            $pdf = Pdf::loadView('books.reportPdf', ["books" => $books]);
            return ["books" => $books, "categories" => $categories, "category_id" => $category_id, "boolPdf" => $pdf];
        }

        return ["books" => $books, "categories" => $categories, "category_id" => $category_id, "boolPdf" => ""];
    }

    public function getBooksIndex() : Collection {
        return $this->bookRepository->getBooksIndex();
    }

    public function getBookByIdIndex(Request $request) {
        return $this->bookRepository->getBookByIdIndex($request->id);
    }

    public function getBookByIdLimitIndex(int $id) {
        return $this->bookRepository->getBookByIdLimitIndex($id);
    }

    public function fiveBestBooks() {
        return $this->bookRepository->fiveBestBooks();
    }
}