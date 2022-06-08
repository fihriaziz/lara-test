<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\api\ProfileResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return response()->json([
            'data' => new ProfileResource($user)
        ]);
    }


















    public function logout(Request $req)
    {
        $req->user()->currentAccessToken()->delete();
    }
}
