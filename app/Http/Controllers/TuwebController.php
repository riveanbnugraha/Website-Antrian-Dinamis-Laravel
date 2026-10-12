<?php

namespace App\Http\Controllers;

use App\Models\Tuweb;

class TuwebController extends Controller
{
    public function index()
    {
        $tuwebs = Tuweb::all();
        return view('tuweb', compact('tuwebs'));
    }
}
