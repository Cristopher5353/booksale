<?php

namespace App\Services;

use App\Repositories\SaleDetailRepository;
use App\Models\SaleDetail;

class SaleDetailService {
    protected $saleDetailRepository;

    public function __construct(SaleDetailRepository $saleDetailRepository) {
        $this->saleDetailRepository = $saleDetailRepository;
    }

    public function saveSaleDetail(SaleDetail $saleDetail) {
        $this->saleDetailRepository->saveSaleDetail($saleDetail);
    }

    public function getSaleDetailSBySale(int $saleId) {
        $this->saleDetailRepository->getSaleDetailSBySale($saleId);
    }
}