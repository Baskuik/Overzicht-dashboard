<?php

namespace App\Http\Controllers;

use App\Models\Record;
use App\Models\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\RecordsImport;

class UploadController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
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
        Excel::import(new RecordsImport($upload->id), $file);

        return redirect()->back()->with('success', "Bestand '{$fileName}' succesvol geüpload!");
    }
}
