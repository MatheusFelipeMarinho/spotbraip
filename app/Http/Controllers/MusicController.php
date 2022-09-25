<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Music;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class MusicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $music = Music::query();

        if(!$request->name){
            $musics = $music->orderBy('plays', 'asc')->paginate(50);
            return response()->json([
                "data" => $musics
            ]);
        }

        $musics = $music->where('name', 'like', '%' . $request->name . '%')->get();

        return response()->json([
            "data" => $musics
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Music $music)
    {
        $user_id = auth()->user()->id;

        $disk = Storage::disk('public');
        $fileAudio = $request->file('audio');
        $fileImage = $request->file('image');
        $extensionAudio = $request->file('audio')->getClientOriginalExtension();
        $extensionImage = $request->file('image')->getClientOriginalExtension();
        $duration = $request->file('audio')->getSize();

        $hash = Hash::make(Carbon::now()->format('Ymd').'_'.$request->name);

        if($request->hasFile('audio')){
            $disk->putFileAs($user_id.'/mp3/', $fileAudio, $hash. '.' .$extensionAudio);
        }

        if($request->hasFile('image')){
            $disk->putFileAs($user_id.'/thumb/', $fileAudio, $hash. '.' .$extensionImage);
        }


        $data = [
            'album_id' => $request->album_id,
            'user_id' => $user_id,
            'name' => $request->name,
            'hash' => $hash. '.' .$extensionAudio,
            'original_name' => $request->file('audio')->getClientOriginalName(),
            'extension' => $request->file('audio')->getClientOriginalExtension(),
            'image_path' => $user_id.'/thumb/' . $hash. '.' .$extensionImage,
            'path' => $user_id.'/mp3/'. $hash. '.' .$extensionAudio,
            'duration' => $request->file('audio')->getSize(),
        ];


        if (!$music = $music->create($data)) {
            abort(500, 'Error to create a new music...');
        }

        return response()->json([
            "data" => $music,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $music = Music::find($id);

        if ($stream = fopen('http://www.example.com', 'r')) {
            // print all the page starting at the offset 10
            echo stream_get_contents($stream, -1, 10);

            fclose($stream);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
