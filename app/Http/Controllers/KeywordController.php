<?php

namespace App\Http\Controllers;
use App\Models\Keyword;

use Illuminate\Http\Request;

class KeywordController extends Controller
{
    public function upload(Request $request)
    {
       // dd($request->all());
        $request->validate([
            'file' => 'required|mimes:txt,doc,docx'
        ]);

        $file = $request->file('file');
        $contents = file($file->getRealPath(), FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        $currentLetter = null;
        $wordsToInsert = [];

        foreach ($contents as $line) {
            $line = trim($line);
            if (!$line) continue;

            // Detect alphabet header (single letter)
            if (preg_match('/^[a-zA-Z]$/', $line)) {
                $currentLetter = strtolower($line);
                continue;
            }

            // Otherwise add as a word
            $wordsToInsert[] = [
                'letter' => $currentLetter ?? '',
                'word'   => $line,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        Keyword::insert($wordsToInsert);

        return back()->with('success', count($wordsToInsert).' words uploaded successfully!');
    }
}
