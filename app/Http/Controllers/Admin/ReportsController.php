<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProduct;

class ReportsController extends Controller
{
    public function sale()
    {
        $result = Order::SaleInMonth();
        $orders = OrderProduct::distinct(['product_id', 'id'])->get();

        foreach ($result as $res) {
            $total[] = $res->total;
            $count[] = $res->count;
            $products[] = $res->products;
            $month[] = $res->month . $res->year . '(' . $res->count . ')';
        }
        return view('admin.home', compact('count', 'total', 'month', 'products', 'orders'));
    }
}
