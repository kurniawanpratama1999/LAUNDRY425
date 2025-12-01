<?php

namespace App\Http\Controllers;

use App\Models\Detail;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function index()
    {
        $details = Detail::all();
        

        return view('pages.report', compact('details', ));
    }
}
