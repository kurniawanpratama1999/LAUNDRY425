<?php

namespace App\Http\Controllers;

use App\Models\Pickup;

class PickupController extends Controller
{
    public function index()
    {
        $pickups = Pickup::with('customer', 'order')->get();

        return view('pages.pickup', compact('pickups'));
    }
}
