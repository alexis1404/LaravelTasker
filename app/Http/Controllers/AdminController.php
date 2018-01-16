<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\Notifications\TaskEdit;
use Storage;
use Sentinel;
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

        if(isset($request->notify) && $request->notify != null){
            Notification::send(User::find($request->user_id), new TaskEdit($task));
        }

        $task->save();

        return response('1',200);
    }

    public function getUser($id)
    {
        $user = User::find($id);

        return new JsonResponse($user);
    }

    public function editUser($id, Request $request)
    {
        $user = Sentinel::findById($id);
        $credentials = [];

        if(isset($request->name)){
            $credentials['first_name'] = $request->name;
        }

        if(isset($request->email)){
            $credentials['email'] = $request->email;
        }

        if(isset($request->password)){
            $credentials['password'] = $request->password;
        }

        Sentinel::update($user, $credentials);

        if(isset($request->notify) && $request->notify != null){

        }

        return response('1', 200);
    }
}
