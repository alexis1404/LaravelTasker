<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Storage;
use App\User;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.main');
    }

    public function users()
    {
        $users = User::with('tasks')->get();

        return new JsonResponse($users);
    }

    public function getUserTasks($id)
    {

        return new JsonResponse(User::find($id)->tasks);

    }

    public function deleteTask($id)
    {
        Task::find($id)->delete();

        return response('1', 200);
    }

    public function getTask($id)
    {
        return new JsonResponse(Task::find($id));
    }

    public function editTask($id, Request $request)
    {
        $task = Task::find($id);

        if(isset($request->name)){
            $task->name = $request->name;
        }

        if(isset($request->description)){
            $task->description = $request->description;
        }

        if(isset($request->status)){
            $task->status = $request->status;
        }

        $file = $request->file('image');

        if($file && $file->isValid()){
            Storage::disk('public')->delete($task->image);
            $url = Storage::disk('public')->put('', $file);
            $task->image =  $url;
        }

        $task->save();

        return response('1',200);
    }

    public function getUser($id)
    {
        $user = User::find($id);

        return new JsonResponse($user);
    }
}
