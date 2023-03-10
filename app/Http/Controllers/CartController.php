<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\Sale;
use App\Models\SaleDetail;
use App\Services\CartService;

class CartController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService) {
        $this->cartService = $cartService;
    }

    public function index() {
        $cart = $this->cartService->getCart();
        return view("cart.index", compact("cart"));
    }

    public function addProductToCart(Request $request)  {
        $this->cartService->addProductToCart($request);
        $cart  = $this->cartService->getCart();

        return redirect()->route("cart");
    }

    public function updateProductToCart(Request $request) {
        $this->cartService->updateProductToCart($request);
        return redirect()->route("cart");
    }

    public function deleteProductToCart(Request $request) {
        $this->cartService->deleteProductToCart($request);
        return redirect()->route("cart");
    }

    public function processCart() {
        $response = $this->cartService->processCart();
        return redirect()->route($response["route"])->with([$response["key"] => $response["value"]]);
    }

}
