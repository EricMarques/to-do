<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Task;
use App\User;
use App\Invitation;

class ToDoController extends Controller
{
    public function index()
    {
    	//$tasks = Task::all();
        $tasks = Task::paginate(10);
        //$tasks = Task::where('user_id', 2)->paginate(10);
        //$tasks = Task::where('status', 0)->paginate(10);
        //$tasks = Task::where('user_id', Auth::user()->id)->paginate(10);
        //$tasks = Task::where('user_id', Auth::user()->id)->orderBy('user_id')->paginate(10);
        $coworkers = User::where('is_admin', 1)->get();
    	return view('index', compact('tasks', 'coworkers'));
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

    public function updateStatus($id)
    {
        $task = Task::find($id);
        $task->status = !$task->status;
        $task->save();
        return redirect()->back();
    }

    public function sendInvitation(Request $request)
    {
        if( (int) $request->input('admin') > 0 
            && !Invitation::where('worker_id', Auth::user()->id)->where('admin_id', $request->input('admin'))->exists()
        )
        {
            $invitation = new Invitation;
            $invitation->worker_id = Auth::user()->id;
            $invitation->admin_id = $request->input('admin');
            $invitation->save();

        }
        return redirect('/');
    }
}
