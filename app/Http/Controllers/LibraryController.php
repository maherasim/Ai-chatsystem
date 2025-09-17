<?php

namespace App\Http\Controllers;

use App\Models\Keyword;
use Illuminate\Http\Request;
use App\Models\Setting;

class LibraryController extends Controller
{

    public function index()
    {
        $words = \App\Models\Keyword::orderBy('letter')->orderBy('word')->get();

        // Group by letter
        $grouped = $words->groupBy('letter');
        $headers = Setting::all();

        return view('Chats.library', compact('grouped', 'headers'));
    }
}
