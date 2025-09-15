<?php

namespace App\Http\Controllers;

use App\Models\Keyword;
use Illuminate\Http\Request;

class LibraryController extends Controller
{

    public function index()
{
    $words = \App\Models\Keyword::orderBy('letter')->orderBy('word')->get();

    // Group by letter
    $grouped = $words->groupBy('letter');

    return view('Chats.library', compact('grouped'));
}

}

