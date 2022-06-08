<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Goal;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        try {
            $user = Auth::user();
            $goal = Goal::all();
            $task = Task::all();

            return response()->json([
                'user' => $user,
                'goal' => $goal,
                'task'  => $task
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }
    }
}
