<?php

namespace App\Http\Controllers;

use App\Models\Keyword;
use Illuminate\Http\Request;

class LibraryController extends Controller
{
    public function index(Request $request)
    {
        $q = trim((string) $request->get('q', ''));

        $query = Keyword::query();

        if ($q !== '') {
            // Case-insensitive contains search
            $query->where('name', 'like', '%' . $q . '%');
        }

        // Fetch all Kurdish keywords; for large sets, consider pagination/lazy loading
        $all = $query->orderBy('name', 'asc')->get(['name']);

        // Group by first uppercase letter (non-letters grouped under '#')
        $grouped = [];
        foreach ($all as $item) {
            $name = (string) ($item->name ?? '');
            if ($name === '') {
                continue;
            }
            $first = mb_strtoupper(mb_substr($name, 0, 1));
            $key = preg_match('/[A-ZÇĞİÖŞÜÊÎÛ]/u', $first) ? $first : '#';
            if (!isset($grouped[$key])) {
                $grouped[$key] = [];
            }
            $grouped[$key][] = $name;
        }

        ksort($grouped, SORT_LOCALE_STRING);

        return view('Chats.library', [
            'groupedKeywords' => $grouped,
            'search' => $q,
        ]);
    }
}

