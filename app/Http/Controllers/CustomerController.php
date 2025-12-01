<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::where('deleted_at', '=', null)->get();

        return view('pages.customer', compact('customers'));
    }

    public function show(Request $req, int $id)
    {
        $customers = Customer::where('deleted_at', '=', null)->get();
        $customer = Customer::findOrFail($id);

        return view('pages.customer', compact('customers', 'customer'));
    }

    public function store(Request $req)
    {
        $validated = $req->validate([
            'name' => ['required', 'string'],
            'phone' => ['required', 'string'],
            'address' => ['required', 'string'],
        ]);

        try {
            Customer::create($validated);

            return redirect()->route('customer.index');
        } catch (\Throwable $th) {
            return back()->withInput();
        }
    }

    public function update(Request $req, int $id)
    {
        $customer = Customer::findOrFail($id);
        $validated = $req->validate([
            'name' => ['required', 'string'],
        ]);

        try {
            $customer->update($validated);

            return redirect()->route('customer.index');
        } catch (\Throwable $th) {
            return back()->withInput();
        }
    }

    public function destroy(int $id)
    {
        try {
            Customer::destroy($id);

            return redirect()->route('customer.index');
        } catch (\Throwable $th) {
            return back()->withInput();
        }
    }
}
