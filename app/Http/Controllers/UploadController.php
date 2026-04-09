<?php

namespace App\Http\Controllers;

use App\Models\Record;
use App\Models\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Imports\RecordsImport;

class UploadController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'file' => 'required|mimes:xlsx,xls|max:10240',
            ]);

            $file = $request->file('file');
            $fileName = $file->getClientOriginalName();

            // Upload record aanmaken
            $upload = Upload::create([
                'user_id' => Auth::id(),
                'file_name' => $fileName,
                'upload_date' => now()->toDateString(),
            ]);

            // Excel verwerken
            $importer = new RecordsImport($upload->id);
            $importer->import($file->getRealPath());

            return redirect()->route('dashboard')->with('success', "Bestand '{$fileName}' succesvol geüpload!");
        } catch (\Exception $e) {
            return redirect()->route('dashboard')->withErrors(['file' => 'Upload failed: ' . $e->getMessage()]);
        }
    }
}
