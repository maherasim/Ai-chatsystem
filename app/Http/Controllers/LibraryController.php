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
        $pageSize = (int) $request->query('page_size', 25);
        $allowedSizes = [25, 50, 100];
        if (!in_array($pageSize, $allowedSizes, true)) {
            $pageSize = 25;
        }
        if (!preg_match('/^[a-z]$/', $selectedLetter)) {
            $selectedLetter = null;
        }
        $headers = Setting::all();
        $words = Keyword::query()
            ->when($selectedLetter, fn ($q) => $q->where('letter', $selectedLetter))
            ->orderBy('letter')
            ->orderBy('word')
            ->paginate($pageSize)
            ->withQueryString();

        // Group only the current page items to keep the existing view structure
        $grouped = collect($words->items())->groupBy('letter');

        return view('Chats.library', compact('grouped', 'selectedLetter','headers', 'words', 'pageSize'));
    }
}
