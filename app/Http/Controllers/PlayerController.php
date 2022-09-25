<?php

namespace App\Http\Controllers;

use App\Models\Music;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class PlayerController extends Controller
{
    public function index(Request $request)
    {
        $music = Music::find($request->id);

        $path = Storage::disk('public')->path($music->path);

        $filename = storage_path($path);
        $filesize = $music->duration;

        $file = File::get($path);

        $response = Response::make($file, 200);
        $response->header('Content-Type', 'audio/mp3');
        $response->header('Content-Length', $filesize);
        $response->header('Accept-Ranges', 'bytes');
        $response->header('Content-Range', 'bytes 0-'.$filesize.'/'.$filesize);

        return $response;
    }

}
