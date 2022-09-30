<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlaylistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $playlist = Playlist::query();

        if($request->name){
            $playlist->where('name', 'like', '%' . $request->name . '%');
        }

        $playlist->with('musics');

        $result = $playlist->get();

        return response()->json($result);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Playlist $playlist)
    {
        $data = [
            'user_id' => auth()->user()->id,
            'name' => $request->name
        ];

        if (!$playlist = $playlist->create($data)) {
            abort(500, 'Error to create a new playlist...');
        }

        return response()->json([
            "data" => $playlist,
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
        $playlist = Playlist::with('musics')->find($id);
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
        $playlist = Playlist::find($id);

        $data = [
            'user_id' => auth()->user()->id,
            'name' => $request->name
        ];

        if (!$playlist = $playlist->update($data)) {
            abort(500, 'Error to create a new playlist...');
        }

        return response()->json([
            "data" => $playlist,
        ]);
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
