<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Pickup;
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
            $findOrder = Order::with('details')->findOrFail($id);
            $findOrder->update([
                'status' => 1,
            ]);

            $notes = $findOrder->details->pluck('notes')->filter()->implode(', ');

            Pickup::create(
                [
                    'customer_id' => $findOrder->customer_id,
                    'order_id' => $findOrder->customer_id,
                    'pickup_date' => now(),
                    'notes' => $notes,
                ]
            );

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
