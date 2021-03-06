<?php

namespace App\Http\Controllers;

use App\{Task, Project};
use Illuminate\Support\Facades\Mail;
use App\Mail\TaskEditedMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('owner', ['except' => [
            'index',
        ]]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Project $project)
    {
        $project_id = request()->route('project_id');
        $status =request()->route('status');
        
        $tasks = Task::where('status', $status)
            ->where('project_id', $project_id)
            ->get();
        
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
        $id = request()->route('project_id');

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
    public function show()
    {
        $task_id = request()->route('task_id');
        $task = Task::find($task_id);

        return view('tasks.show', [
            'task' => $task
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $task_id = request()->route('task_id');
        $task = Task::find($task_id);

        return view('tasks.edit', [
            'task' => $task,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $attributes = $this->validateTask();

        $task_id = request()->route('task_id');
        $task = Task::find($task_id);
        // $project = Project::find($task->project_id);

        $task->update($attributes);

        return redirect('/projects/'.$task->project_id.'/'.$task->status.'/'.$task->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task_id = request()->route('task_id');
        $project_id = request()->route('project_id');
        $task = Task::find($task_id);

        $task->delete();

        return redirect('/projects/'.$project_id);
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

    public function download()
    {
        $filename = request()->route('filename');

        $file_path = storage_path().'/app/public/'.$filename;

        if (file_exists($file_path)) {
            return Storage::download('public/'.$filename);
        } else {
            echo 'Sorry, file does not exist';
        }
    }
}
