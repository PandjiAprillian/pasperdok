<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function adminSearch(Request $request)
    {
        dd($request->all());
    }
}
