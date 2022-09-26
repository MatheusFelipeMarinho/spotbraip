<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AddMusicPlaylistController extends Controller
{
    public function addMusicToPlaylist(Request $request, PlaylistMusic $playlistMusic)
    {
        $data = $request->only('playlist_id', 'music_id', 'music_name');

        $this->checkMusicAlreadyExistInplayList($data);

        if (!$playlistMusic = $playlistMusic->create($data)) {
            abort(500, 'Error to add music...');
        }

        return response()->json([
            "data" => 'Music Added',
        ]);
    }

    public function removeMusicToPlaylist($id)
    {
        $data = $request->only('playlist_id', 'music_id', 'music_name');


        $playlistMusic = PlaylistMusic::query()
            ->where('playlist_id', $data['playlist_id'])
            ->where('music_id', $data['music_id'])
            ->first();

        if (!$playlistMusic = $playlistMusic->delete($data)) {
            abort(500, 'Error to remove music...');
        }

        return response()->json([
            "data" => 'Music removed',
        ]);
    }

    private function checkMusicAlreadyExistInplayList($data)
    {
        $playlist_id = $data['playlist_id'];
        $music_id    = $data['music_id'];

        $playlistMusic = PlaylistMusic::query();

        $playlistMusic->where('playlist_id', $playlist_id)->where('music_id', $music_id)->first();

        if(!$playlistMusic->id){
            return true;
        }

        throw new Exception('Music Already exists');
    }
}
