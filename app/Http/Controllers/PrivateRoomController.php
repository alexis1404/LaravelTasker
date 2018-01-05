<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use Storage;
use Sentinel;

class PrivateRoomController extends Controller
{
    public function index()
    {
        $all_tasks = Task::all();

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
            $path = rand(1, 99999) . '_' . $file->getClientOriginalName();
            $file->move(storage_path('images'), $path);
            $new_task->image = 'images' . "/" . $path;
        }


        $new_task->user()->associate($user = Sentinel::check());

        $new_task->save();

        return redirect('/private_room');
    }
}
