<?php

namespace App\Repositories;
use DB;

class UserRepository {
    public function quantityCustomers() {
        return DB::table('users')
                ->where('role_id', '=', '2')
                ->count();
    }

    public function fiveBestCustomers() {
        return DB::table('sales')
                ->rightJoin('users', 'sales.user_id', '=', 'users.id')
                ->select('sales.user_id AS id', DB::raw('CONCAT(users.name, " ", users.surname) AS user'), DB::raw('SUM(sales.total) AS total'))
                ->where('users.role_id', '=', 2)
                ->groupBy('id', 'user')
                ->limit(5)
                ->get();
    }
}