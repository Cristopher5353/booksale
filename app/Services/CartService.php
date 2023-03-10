<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Repositories\BookRepository;
use App\Repositories\SaleRepository;
use App\Repositories\SaleDetailRepository;
use App\Models\Sale;
use App\Models\SaleDetail;
use Illuminate\Support\Facades\Storage;

class CartService {
    protected $bookRepository;
    protected $saleRepository;
    protected $saleDetailRepository;

    public function __construct(BookRepository $bookRepository, SaleRepository $saleRepository, SaleDetailRepository $saleDetailRepository) {
        $this->bookRepository = $bookRepository;
        $this->saleRepository = $saleRepository;
        $this->saleDetailRepository = $saleDetailRepository;
    }

    public function getCart() {
        return \Cart::getContent();
    }

    public function addProductToCart(Request $request) : void {
        $book = $this->bookRepository->getBookByIdCart($request->id);

        $firstImage = explode(",", $book->images)[0];
        \Cart::add(array(
            'id' => $book->id,
            'name' => $book->title,
            'price' => ($book->price) - ($book->discount),
            'quantity' => ($request->quantity != 0) ?$request->quantity :1,
            'attributes' => array(
                'image' => $firstImage
            )
        ));
    }

    public function updateProductToCart(Request $request) : void {
        \Cart::update($request->id, array(
            'quantity' => array(
                'relative' => false,
                'value' => $request->quantity
            ),
        ));
    }

    public function deleteProductToCart(Request $request) {
        \Cart::remove($request->id);
    }

    public function processCart() {
        $books = \Cart::getContent();
        $total = \Cart::getTotal();
        $pdfs = array();

        if(\Cart::isEmpty()) {
            return ["route" => "cart", "key" => "messageError", "confirm" => 0, "value" => "El carrito de compras esta vacío"];
        } 

        try {
            DB::beginTransaction();
            $sale = new Sale();
            $sale->user_id = Auth::user()->id;
            $sale->total = $total;
            $this->saleRepository->saveSale($sale);

            foreach($books as $book) {
                $saleDetail = new SaleDetail();
                $saleDetail->sale_id = $sale->id;
                $saleDetail->book_id = $book->id;
                $saleDetail->quantity = $book->quantity;
                $saleDetail->subtotal = ($book->price * $book->quantity);
                $this->saleDetailRepository->saveSaleDetail($saleDetail);

                array_push($pdfs, $this->bookRepository->getBookById($book->id)->pdf);
            }

            Mail::send('cart.email', ['user' => Auth::user(), 'sale' => $sale, 'books' => $books], function ($message) use ($pdfs)
            {
                $message->from('booksale@gmail.com', 'BookSale');
                $message->to(Auth::user()->email)->subject('¡¡Detalle de Compra BookSale!!');

                for ($i = 0; $i < count($pdfs); $i++) { 
                    $message->attach(storage_path('app/private/documents/books/'.$pdfs[$i]));
                }
            });
            
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return ["route" => "cart", "key" => "messageError", "confirm" => 0, "value" => $e->getMessage()];
        }
        
        \Cart::clear();
        return ["route" => "index", "key" => "message", "confirm" => 1, "value" => "Compra realizada correctamente, te enviamos un correo con el detalle de tu compra ✌📚"];
    }
}