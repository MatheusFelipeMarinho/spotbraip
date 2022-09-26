<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    /**
     * Like a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function like(Request $request, Like $like)
    {
        $this->authorize('create', $like);

        $data = [
            'user_id' => auth()->user()->id,
            'music_id' => $request->music_id
        ];

        if (!$like = $like->create($data)) {
            abort(500, 'Error to like music...');
        }

        return response()->json([
            "data" => $like,
        ]);
    }

    public function deslike($music_id)
    {
        $user_id = auth()->user()->id;

        $like = Like::where('music_id', $music_id)->where('user_id', $user_id)->first();

        if (!$like->delete($like->id)) {
            abort(500, 'Error to deslike music...');
        }

        return response()->json(['message' => 'Deleted']);
    }

}
