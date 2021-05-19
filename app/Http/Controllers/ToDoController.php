<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Task;

class ToDoController extends Controller
{
    public function index()
    {
    	$tasks = Task::all();
    	return view('index', compact('tasks'));
    }

    public function store(Request $request)
    {
    	if($request->input('task'))
    	{
	    	$task = new Task;
	    	$task->content = $request->input('task');

    		Auth::user()->tasks()->save($task);
    	}

    	return redirect()->back();

    }

    public function edit($id)
    {
    	$task = Task::find($id);
    	return view('edit', ['task'=>$task]);
    }

    public function update($id, Request $request)
    {
    	if($request->input('task'))
    	{
	    	$task = Task::find($id);
		    $task->content = $request->input('task');
		    $task->save();
    	}
    	return redirect('/');
    }

    public function delete($id)
    {
    	$task = Task::find($id);
    	$task->delete();
    	return redirect()->back();
    }
}
