<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Detail;
use App\Models\Order;
use App\Models\Service;
use DateTime;
use DateTimeZone;
use DB;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $services = Service::all();
        $customers = Customer::all();

        return view('pages.transaction', compact('services', 'customers'));
    }

    public function store(Request $req)
    {
        $datas = $req->input('datas');
        $order = $datas['order'];
        $orderDetails = $datas['orderDetails'];

        /* ====== ORDER ====== */
        $nextId = DB::select("SHOW TABLE STATUS LIKE 'orders'")[0]->Auto_increment;
        $now = new DateTime('now', new DateTimeZone('Asia/Jakarta'));
        $endDate = new DateTime($order['end_date'], new DateTimeZone('Asia/Jakarta'));
        $order['code'] = 'ORD'.$now->format('dmYHis').str_pad($nextId, 4, '0', STR_PAD_LEFT);
        $order['date'] = $now;
        $order['end_date'] = $endDate;
        $order['status'] = 0;

        DB::beginTransaction();
        try {
            $order = Order::create([
                'customer_id' => $order['customer_id'],
                'code' => $order['code'],
                'date' => $order['date'],
                'end_date' => $order['end_date'],
                'status' => $order['status'],
                'total' => $order['total'],
                'payment' => $order['payment'],
                'change' => $order['change'],
            ]);

            $id = $order->id;

            foreach ($orderDetails as $orderDetail) {
                Detail::create([
                    'order_id' => $id,
                    'service_id' => $orderDetail['service_id'],
                    'quantity' => $orderDetail['quantity'],
                    'subtotal' => $orderDetail['subtotal'],
                    'notes' => $orderDetail['notes'],
                ]);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'redirect' => route('order.index'),
            ]);
        } catch (\Throwable $th) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ]);
        }

    }
}
