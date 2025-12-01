<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('status', '=', 0)->get();

        return view('pages.order', compact('orders'));
    }

    public function updateStatus(Request $req)
    {
        $id = $req->input('id');
        try {
            $findOrder = Order::findOrFail($id);
            $findOrder->update([
                'status' => 1,
            ]);

            return response()->json([
                'success' => true,
                'redirect' => route('order.index'),
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }
}
