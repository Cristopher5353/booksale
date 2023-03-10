<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\UserService;
use App\Services\SaleService;
use App\Services\SaleDetailService;
use App\Services\BookService;

class DashBoardController extends Controller
{
    protected $userService;
    protected $saleService;
    protected $saleDetailService;
    protected $bookService;

    public function __construct(UserService $userService, SaleService $saleService, SaleDetailService $saleDetailService, BookService $bookService) {
        $this->userService = $userService;
        $this->saleService = $saleService;
        $this->saleDetailService = $saleDetailService;
        $this->bookService = $bookService;
    }

    public function index() {
        $totalSales = $this->saleService->totalSales();
        $totalSalesToday = $this->saleService->totalSalesToday();
        $quantityCustomers = $this->userService->quantityCustomers();

        return view("dashboard.index", compact("totalSales", "totalSalesToday", "quantityCustomers"));
    }

    public function getFiveBestBooks(Request $request) {
        $fiveBestBooks = $this->bookService->fiveBestBooks();
               
        if($request->ajax()) {
            return response()->json([
                "fiveBestBooks" => $fiveBestBooks
            ]);
        }
    }

    public function getSalesPerMonth(Request $request) {
        $salesPerMonth = $this->saleService->getSalesPerMonth();

        if($request->ajax()) {
            return response()->json([
                "salesPerMonth" => $salesPerMonth
            ]);
        }
    }

    public function getFiveBestCustomers(Request $request) {
        $fiveBestCustomers = $this->userService->fiveBestCustomers();

        if($request->ajax()) {
            return response()->json([
                "fiveBestCustomers" => $fiveBestCustomers
            ]);
        }
    }
}
