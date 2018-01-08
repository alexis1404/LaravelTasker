<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\User;
use Storage;
use Sentinel;
use Image;
use Illuminate\Http\File;

class PrivateRoomController extends Controller
{
    public function index()
    {
        $user = User::find(Sentinel::check()->id);

        $all_tasks = $user->tasks;


        return view('private', compact('all_tasks'));
    }


    public function createTask(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'description' => 'required',
        ]);

        $new_task = new Task();

        $new_task->name = $request->name;
        $new_task->description = $request->description;
        $new_task->status = false;


        $file = $request->file('image');

        if($file && $file->isValid()) {

            $url = Storage::disk('public')->put('', $file);
            $new_task->image =  $url;

        }

        $new_task->user()->associate($user = Sentinel::check());

        $new_task->save();

        return redirect('/private_room');
    }

    public function deleteTask($id)
    {
        Task::find($id)->delete();

        return redirect('/private_room');
    }

    public function editPage($id)
    {
        $task = Task::find($id);

        return view('edit', compact('task'));
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

        $file = $request->file('image');

        if($file && $file->isValid()){
            Storage::disk('public')->delete($task->image);
            $url = Storage::disk('public')->put('', $file);
            $task->image =  $url;

        }

        $task->save();

        return redirect('/private_room');

    }

}
