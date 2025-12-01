<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::all();

        return view('pages.service', compact('services'));
    }

    public function show(Request $req, int $id)
    {
        $services = Service::all();
        $service = Service::findOrFail($id);

        return view('pages.service', compact('services', 'service'));
    }

    public function store(Request $req)
    {
        $validated = $req->validate([
            'name' => ['required', 'string'],
            'price' => ['required', 'integer'],
            'description' => ['nullable', 'string'],
        ]);

        try {
            Service::create($validated);

            return redirect()->route('service.index');
        } catch (\Throwable $th) {
            return back()->withErrors($th);
        }
    }

    public function update(Request $req, int $id)
    {
        $service = Service::findOrFail($id);
        $validated = $req->validate([
            'name' => ['required', 'string'],
        ]);

        try {
            $service->update($validated);

            return redirect()->route('service.index');
        } catch (\Throwable $th) {
            return back()->withInput();
        }
    }

    public function destroy(int $id)
    {
        try {
            Service::destroy($id);

            return redirect()->route('service.index');
        } catch (\Throwable $th) {
            return back()->withInput();
        }
    }
}
