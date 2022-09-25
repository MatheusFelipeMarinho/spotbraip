<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
    public function store(Request $request, Album $album)
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
