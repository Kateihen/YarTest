<?php

namespace App\Http\Controllers;

use App\{Task, Project};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class TaskController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Project $project)
	{
		$status =request()->route('status');

		$tasks = Task::where('status', $status)->get();

		$status = ucfirst($status);
		
		return view('tasks.index', [
			'status' => $status,
			'tasks' => $tasks,
		]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$id = request()->route('id');

		$project = Project::find($id);

		return view('tasks.create', [
			'project' => $project
		]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$attributes = $this->validateTask($request);

		$task = new Task();
		$att_file = \Request::file('attached_file');

		if ($att_file !== null) {
			$extension = $att_file->guessExtension();
			Storage::disk('public')
				->put($att_file->getFilename().'.'.$extension, File::get($att_file));
			$task->mime = $att_file->getClientMimeType();
			$task->original_filename = $att_file->getClientOriginalName();
			$task->filename = $att_file->getFilename().'.'.$extension;

		}

		$task->task_name = $attributes['task_name'];
		$task->status = $attributes['status'];
		$task->project_id = $attributes['project_id'];
		$task->task_body = $attributes['task_body'];

		$task->save();

		return redirect('/projects/'.$task->project_id);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Task  $task
	 * @return \Illuminate\Http\Response
	 */
	public function show(Task $task)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Task  $task
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Task $task)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Task  $task
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Task $task)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Task  $task
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Task $task)
	{
		//
	}

	public function validateTask()
	{
		return \request()->validate([
			'task_name' => ['required', 'min:3', 'max:255'],
			'project_id' => ['min:1'],
			'task_body' => ['required', 'min:10'],
			'status' => ['required'],
		]);
	}
}
