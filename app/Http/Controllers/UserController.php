<?php

namespace App\Http\Controllers;

use App\Models\Level;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        $levels = Level::all();

        return view('pages.user', compact('users', 'levels'));
    }

    public function show(Request $req, int $id)
    {
        $users = User::all();
        $user = User::findOrFail($id);
        $levels = Level::all();

        return view('pages.user', compact('users', 'user', 'levels'));
    }

    public function store(Request $req)
    {
        $validated = $req->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'email'],
            'level_id' => ['required', 'integer'],
            'password' => ['required', 'string'],
            'password_confirmation' => ['required', 'same:password'],
        ]);

        try {
            unset($validated['password_confirmation']);
            $validated['password'] = Hash::make($validated['password']);

            User::create($validated);

            return redirect()->route('user.index');
        } catch (\Throwable $th) {
            return back()->withInput($req->except('password', 'password_confirmation'));
        }
    }

    public function update(Request $req, int $id)
    {
        $user = User::findOrFail($id);
        $validated = $req->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'email'],
            'level_id' => ['required', 'integer'],
            'password' => ['nullable', 'string'],
            'password_confirmation' => ['nullable', 'same:password'],
        ]);

        try {
            if ($req->filled('password')) {
                $validated['password'] = Hash::make($validated['password']);
            } else {
                unset($validated['password'], $validated['password']);
            }

            $user->update($validated);

            return redirect()->route('user.index');
        } catch (\Throwable $th) {
            return back()->withInput();
        }
    }

    public function destroy(int $id)
    {
        try {
            User::destroy($id);

            return redirect()->route('user.index');
        } catch (\Throwable $th) {
            return back()->withInput();
        }
    }
}
