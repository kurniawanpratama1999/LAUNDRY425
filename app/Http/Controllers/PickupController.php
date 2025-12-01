<?php

namespace App\Http\Controllers;

use App\Models\Order;

class PickupController extends Controller
{
    public function index()
    {
        $orders = Order::where('status', '=', 1)->get();

        return view('pages.pickup', compact('orders'));
    }
}
