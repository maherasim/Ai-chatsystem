<?php

namespace App\Http\Controllers;
use App\Models\Keyword;
use Illuminate\Http\Request;

class KeywordController extends Controller
{
    public function upload(Request $request)
    {
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

            if (preg_match('/^[a-zA-Z]$/', $line)) {
                $currentLetter = strtolower($line);
                continue;
            }

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

    public function update(Request $request, $id)
    {
        $request->validate([
            'word' => 'required|string|max:255',
        ]);

        $keyword = Keyword::find($id);
        if (!$keyword) {
            return back()->with('error', 'Word not found.');
        }

        $newWord = trim($request->input('word'));
        $keyword->word = $newWord;
        $keyword->letter = strtolower(substr($newWord, 0, 1) ?: '');
        $keyword->save();

        return back()->with('success', 'Word updated successfully.');
    }

    public function destroy($id)
    {
        $keyword = Keyword::find($id);
        if (!$keyword) {
            return back()->with('error', 'Word not found.');
        }

        $keyword->delete();
        return back()->with('success', 'Word removed successfully.');
    }
}