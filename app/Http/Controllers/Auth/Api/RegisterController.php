<?php

namespace App\Http\Controllers\Auth\Api;

use App\Models\User;
use App\Enum\UserType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterUsers;
use App\Http\Requests\RegisterSinger;

class RegisterController extends Controller
{
    public function singer(RegisterSinger $request, User $user)
    {
        $userData = $request->only(
            'name',
            'nickname',
            'bio',
            'email',
            'password'
        );

        $userData['type'] = UserType::SINGER;

        if (!$user = $user->create($userData)) {
            abort(500, 'Error to create a new user...');
        }

        $user->assignRole('singer');

        return response()->json(['data' => [ 'user' => $user]]);
    }

    public function user(RegisterUsers $request, User $user)
    {
        $userData = $request->only(
            'name',
            'nickname',
            'email',
            'password'
        );

        $userData['type'] = UserType::FREMIUM;

        if (!$user = $user->create($userData)) {
            abort(500, 'Error to create a new user...');
        }

        $user->assignRole('freemium');

        return response()->json(['data' => [ 'user' => $user]]);
    }

    public function admin(RegisterUsers $request, User $user)
    {
        $userData = $request->only(
            'name',
            'nickname',
            'email',
            'password'
        );

        $userData['type'] = UserType::ADMIN;

        if (!$user = $user->create($userData)) {
            abort(500, 'Error to create a new user...');
        }

        $user->assignRole('admin');

        return response()->json(['data' => [ 'user' => $user]]);
    }
}
