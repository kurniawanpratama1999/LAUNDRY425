<?php

namespace App\Http\Controllers;

use App\Models\Detail;
use App\Models\Order;

class DetailController extends Controller
{
    public function index()
    {
        $details = Detail::all();

        return view('pages.detail', compact('details'));
    }

    public function show(int $id)
    {
        $details = Detail::with('service')->where('order_id', '=', $id)->get();
        $order = Order::where('id', '=', $id)->first();

        return view('pages.detail', compact('details', 'order'));
    }

    public function printStruk(int $id)
    {
        $details = Detail::with('service')->where('order_id', '=', $id)->get();
        $order = Order::where('id', '=', $id)->first();

        return view('pages.printstruk', compact('details', 'order'));
    }
}
