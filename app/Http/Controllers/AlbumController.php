<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;
use App\Http\Requests\AlbumRequest;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $album = Album::query();

        if($request->name){
            $album->where('name', 'like', '%' . $request->name . '%');
        }

        $result = $album->get();

        return response()->json($result);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AlbumRequest $request, Album $album)
    {
        $this->authorize('create', $album);

        $data = $request->only('name', 'description');

        if (!$album = $album->create($data)) {
            abort(500, 'Error to create a new album...');
        }

        $album_genres = $request->genres;

        foreach($album_genres as $value){
            $album->genre()->create([
                'genre_id' => $value,
                'album_id' => $album->id
            ]);
        }

        return response()->json([
            "data" => $album,
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AlbumRequest $request, $id)
    {
        $album = Album::find($id);
        
        $this->authorize('update', $album);

        if(!$album){
            throw new Exception('Album not found.');
        }

        $data = $request->only('name', 'description');

        if (!$album = $album->update($data)) {
            abort(500, 'Error to create a new album...');
        }

        $album_genres = $request->genres;

        foreach($album_genres as $value){
            $album->genre()->create([
                'genre_id' => $value,
                'album_id' => $album->id
            ]);
        }

        return response()->json([
            "data" => $album,
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
