<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;
use App\Http\Requests\GenreRequest;

class GenreController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $genre = Genre::query();

        if($request->name){
            $genre->where('name', 'like', '%' . $request->name . '%');
        }

        $result = $genre->get();

        return response()->json($result);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GenreRequest $request, Genre $genre)
    {
        $this->authorize('create', $genre);

        $data = $request->only('name', 'description');

        if (!$genre = $genre->create($data)) {
            abort(500, 'Error to create a new genre...');
        }

        return response()->json([
            "data" => $genre,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GenreRequest $request, $id)
    {
        $genre = Genre::find($id);

        $this->authorize('update', $genre);

        $data = $request->only('name', 'description');

        if (!$genre = $genre->update($data)) {
            abort(500, 'Error to updated genre...');
        }

        return response()->json([
            "data" => 'Genre updated',
        ]);
    }
}
