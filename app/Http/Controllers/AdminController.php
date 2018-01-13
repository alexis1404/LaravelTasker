<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
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

        return new JsonResponse(1);
    }

    public function getTask($id)
    {
        return new JsonResponse(Task::find($id));
    }
}
