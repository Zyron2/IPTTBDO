<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DropboxController extends Controller
{
    public function index(Request $request)
    {
        $directory = 'dropbox/' . $request->user()->id;
        $files = [];

        foreach ((array) Storage::disk('public')->files($directory) as $path) {
            $files[] = [
                'name' => basename($path),
                'path' => $path,
                'size' => Storage::disk('public')->size($path),
                'url' => Storage::disk('public')->url($path),
            ];
        }

        usort($files, fn ($a, $b) => strcasecmp($a['name'], $b['name']));

        return view('documents.index', ['files' => $files]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'documents' => ['required', 'array', 'max:10'],
            'documents.*' => ['required', 'file', 'mimes:pdf,doc,docx,jpg,jpeg,png,zip', 'max:2048'],
        ]);

        $directory = 'dropbox/' . $request->user()->id;
        $count = 0;

        foreach ($data['documents'] as $doc) {
            $original = preg_replace('/[^A-Za-z0-9._-]/', '_', $doc->getClientOriginalName());
            $name = $original;
            $i = 1;
            while (Storage::disk('public')->exists($directory . '/' . $name)) {
                $name = pathinfo($original, PATHINFO_FILENAME) . '-' . $i++ . '.' . pathinfo($original, PATHINFO_EXTENSION);
            }
            $doc->storeAs($directory, $name, 'public');
            $count++;
        }

        return redirect()->route('documents.index')
            ->with('success', $count . ' document' . ($count === 1 ? '' : 's') . ' uploaded to your dropbox.');
    }

    public function destroy(Request $request, string $file)
    {
        $path = 'dropbox/' . $request->user()->id . '/' . $file;

        abort_unless(Storage::disk('public')->exists($path), 404);

        Storage::disk('public')->delete($path);

        return redirect()->route('documents.index')
            ->with('success', 'Document deleted.');
    }
}
