<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Services\BookService;
use App\Services\CategoryService;

class BookController extends Controller
{
    protected $bookService;
    protected $categoryService;

    public function __construct(BookService $bookService, CategoryService $categoryService) {
        $this->bookService = $bookService;
        $this->categoryService = $categoryService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = $this->bookService->getBooks();
        return view("books.index", compact("books"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->categoryService->getCategoriesByStateActive();
        return view("books.create", compact("categories"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $responseSave = $this->bookService->saveBook($request);
        return redirect()->route("mantenimiento-libros." . $responseSave["route"])->with([$responseSave["key"] => $responseSave["value"]]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $book = $this->bookService->getBookById($id);
        $categories = $this->categoryService->getCategoriesByStateActive();
        return view("books.edit", compact("book", "categories"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $responseUpdate = $this->bookService->updateBook($request, $id);
        return redirect()->route("mantenimiento-libros." . $responseUpdate["route"])->with([$responseUpdate["key"] => $responseUpdate["value"]]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function changeStateBook(int $id) {
        $this->bookService->changeStateBook($id);
        return redirect()->route("mantenimiento-libros.index")->with(["message" => "Estado de libro actualizado correctamente"]);
    }

    public function bookReport(Request $request) {
        $response = $this->bookService->bookReport($request);

        if($response["boolPdf"] != "") {
            return $response["boolPdf"]->stream();
        } else {
            return view("books.report", $response);
        }
    }

}
