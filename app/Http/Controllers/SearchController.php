<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tuweb;

class SearchController extends Controller
{
    public function search(Request $request)
{
    $input = $request->input('input');

    if (empty($input)) {
        return back()->with('message', 'NIM tidak boleh kosong')->withInput();
    }

    $tuwebs = Tuweb::where('id', $input)->get();

    if ($tuwebs->isEmpty()) {
        return back()->with('message', 'NIM tidak ditemukan')->withInput();
    }

    return view('tuweb', compact('tuwebs'));
}
}