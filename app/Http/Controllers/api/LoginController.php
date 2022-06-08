<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\api\LoginResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $req)
    {
        try {
            $credentials = $req->only(['email','password']);

        if(!Auth::attempt($credentials)){
            return response()->json(['message' => 'Unauthorized'], 401);
        } else {
            $user   = User::where('email', $req->email)->first();
            $token  = $user->createToken('access_token')->plainTextToken;

            return response()->json([
                'data'          => new LoginResource($user),
                'access_token'  => $token,
                'token_type'    => 'Bearer'
            ], 200);
        }
        } catch (\Exception $e) {
            return abort(403);
        }
    }
}
