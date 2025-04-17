<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class R2UploadController extends Controller
{
    public function form()
    {
        return view('r2-upload');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:10240',
        ]);

        $path = Storage::disk('r2')->put('uploads', $request->file('image'));

        //$url = Storage::disk('r2')->url($path);

            // Manually create the public R2.dev link
            $url = "https://pub-b4f55014bc1641c8b34800685e00e9d6.r2.dev/" . $path;


        return back()->with([
            'success' => 'Image uploaded successfully!',
            'url' => $url,
        ]);
    }
}
