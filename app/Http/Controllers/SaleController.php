<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Services\SaleService;

class SaleController extends Controller
{
    protected $saleService;

    public function __construct(SaleService $saleService) {
        $this->saleService = $saleService;
    }

    public function saleReport(Request $request) {
        $response = $this->saleService->saleReport($request);

        if($response["pdf"] != false) {
            return $response["pdf"]->stream();
        }

        return view("sales.report", $response);
    }
    
    public function saleDetailReport(Request $request) {
        $pdf = $this->saleService->saleDetailReport($request);
        return $pdf->stream();
    }
}
