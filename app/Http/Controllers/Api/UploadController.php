<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|file|max:10240',
        ]);

        $file = $request->file('file');
        $folder = $request->input('folder', 'misc');

        $uniqueSuffix = time() . '-' . rand(1000000000, 9999999999);
        $extension = $file->getClientOriginalExtension();
        $filename = $uniqueSuffix . '.' . $extension;

        $path = $file->storeAs('uploads/' . $folder, $filename, 'public');

        $publicPath = '/storage/' . $path;

        return $this->created([
            'url' => $publicPath,
            'filename' => $filename,
        ]);
    }
}
