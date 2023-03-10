<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Repositories\SaleRepository;
use App\Repositories\SaleDetailRepository;
use App\Models\Sale;
use Barryvdh\DomPDF\Facade\Pdf;

class SaleService {
    protected $saleRepository;
    protected $saleDetailRepository;

    public function __construct(SaleRepository $saleRepository, SaleDetailRepository $saleDetailRepository) {
        $this->saleRepository = $saleRepository;
        $this->saleDetailRepository = $saleDetailRepository;
    }

    public function saveSale(Sale $sale) {
        $this->saleRepository->saveSale($sale);
    }
    
    public function totalSales() {
        return $this->saleRepository->totalSales();
    }
    
    public function totalSalesToday() {
        return $this->saleRepository->totalSalesToday();
    }

    public function getSalesPerMonth() {
        return $this->saleRepository->getSalesPerMonth();
    }

    public function saleReport(Request $request) {
        $boolPdf = $request->pdf;
        $sDate = $request->startDate;
        $eDate = $request->endDate;

        if($sDate == NULL && $sDate == NULL) {
            $sales = $this->saleRepository->getSales();

        } else {
            $sales = $this->saleRepository->getSalesBetweenDates([$sDate, $eDate]);
        }

        if($boolPdf == "true") {
            $pdf = Pdf::loadView('sales.reportPdf', ["sales" => $sales]);
            return ["pdf" => $pdf, "sales" => $sales, "sDate" => $sDate, "eDate" => $eDate];
        } 

        return ["pdf" => false, "sales" => $sales, "sDate" => $sDate, "eDate" => $eDate];
    }

    public function saleDetailReport(Request $request) {
        $saleId = $request->venta;
        $sale = $this->saleRepository->getSaleById($saleId);
        $saleDetail = $this->saleDetailRepository->getSaleDetailSBySale($saleId);
        $pdf = Pdf::loadView('sales.reportSaleDetail', ["sale" => $sale, "saleDetail" => $saleDetail]);

        return $pdf;
    }
}