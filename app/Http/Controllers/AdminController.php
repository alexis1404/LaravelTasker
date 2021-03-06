<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\Notifications\TaskEdit;
use App\Notifications\UserEdit;
use App\Mail\TaskMail;
use App\Mail\CurrentTaskMail;
use Mail;
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
         $pass_changed = false;
         $new_password = null;

        $user = Sentinel::findById($id);
        $credentials = [];

        if(isset($request->name)){
            $credentials['first_name'] = $request->name;
        }

        if(isset($request->email)){
            $credentials['email'] = $request->email;
        }

        if(isset($request->password) && $request->password != ''){
            $credentials['password'] = $request->password;
            $pass_changed = true;
            $new_password = $request->password;
        }

        Sentinel::update($user, $credentials);

        if(isset($request->notify) && $request->notify != null){
            Notification::send(User::find($user->id), new UserEdit($user, $pass_changed, $new_password));
        }

        return response('1', 200);
    }

    public function sendMailUser(Request $request)
    {
        $attach = null;

        $user = User::find($request->user_id);

        $file = $request->file('attach');

        if($file && $file->isValid()){
            $attach = $file;
        }

        Mail::to($user->email)
            ->send(new TaskMail($request->mail_message, $attach));

        return response('1', 200);
    }

    public function sendMailTaskUser(Request $request)
    {
        $attach = null;

        $task = Task::find($request->task_id);


        $file = $request->file('attach');

        if($file && $file->isValid()){
            $attach = $file;
        }

        Mail::to($task->user->email)
            ->send(new CurrentTaskMail($task->name, $request->mail_message, $attach));

        return response('1', 200);
    }

}
