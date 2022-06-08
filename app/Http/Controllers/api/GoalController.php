<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\api\GoalResource;
use App\Http\Resources\api\TaskDetailResource;
use App\Models\Goal;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class GoalController extends Controller
{
    public function goal(Request $req)
    {
        try {
            $this->validate($req, [
                'title' => 'required',
                'description' => 'required'
            ]);

            $goal = Goal::create([
                'title'         => $req->title,
                'user_id'       =>  $req->user_id ? $req->user_id : null,
                'description'   => $req->description,
                'attachments'   => $req->attachments ? $req->attachments : null
            ]);

            return response()->json([
                'data'  => new GoalResource($goal)
            ], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Data Gagal Disimpan'], 403);
        }
    }

    public function goalDetail(Request $req)
    {
        try {
            $detail = Goal::with(['tasks'])->where('id', $req->id)->first();

            return response()->json([
                'data' => $detail
            ], 202);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }
    }

    public function upcommingGoal()
    {
        $start     = Carbon::now()->subDays(30);
        $end       = Carbon::now();
        $task      = Task::whereBetween('deadline', [$start, $end])->get();

        return response()->json($task);
    }
}
