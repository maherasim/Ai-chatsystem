<?php

namespace App\Http\Controllers;

use App\Models\Keyword;
use Illuminate\Http\Request;
use App\Models\Setting;

class LibraryController extends Controller
{

    
    public function index(Request $request)
    {
        $selectedLetter = strtolower($request->query('letter', ''));
        if (!preg_match('/^[a-z]$/', $selectedLetter)) {
            $selectedLetter = null;
        }
        $headers = Setting::all();
        $words = Keyword::query()
            ->when($selectedLetter, fn ($q) => $q->where('letter', $selectedLetter))
            ->orderBy('letter')
            ->orderBy('word')
            ->get();

        $grouped = $words->groupBy('letter');

        return view('Chats.library', compact('grouped', 'selectedLetter','headers'));
    }
}
