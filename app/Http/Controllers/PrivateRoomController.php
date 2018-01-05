<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;

class PrivateRoomController extends Controller
{
    public function index()
    {
        $all_tasks = Task::all();

        return view('private', compact('all_tasks'));
    }
}
