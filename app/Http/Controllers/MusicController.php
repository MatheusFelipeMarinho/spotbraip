<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use App\Models\Music;
use Illuminate\Http\Request;
use App\Http\Requests\MusicRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\AbstractController;

class MusicController extends AbstractController
{

    public function __construct(MusicService $service)
    {
        $this->service = $service;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MusicRequest $request, Music $music)
    {
        $this->authorize('create', $music);

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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MusicRequest $request, $id)
    {
        $music = Music::find($id);

        $this->authorize('update', $music);

        if(!$music){
            throw new Exception('$music not found.');
        }

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


        if (!$music = $music->update($data)) {
            abort(500, 'Error to create a new music...');
        }

        return response()->json([
            "data" => $music,
        ]);
    }
}
