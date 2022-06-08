<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\api\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function task(Request $req)
    {
        try {
            $this->validate($req, [
                'title'     => 'required',
                'deadline'  => 'required'
            ]);

            $task = Task::create([
                'user_id'   => $req->user_id ? $req->user_id : null,
                'goal_id'   => $req->goal_id ? $req->goal_id : null,
                'title'     => $req->title,
                'deadline'  => $req->deadline
            ]);

            return response()->json([
                'data' => new TaskResource($task)
            ], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Data tidak bisa disimpan'], 400);
        }
    }
}
