@extends('layouts.app')

@section('title', "- $task->task_name")

@section('content')

	<h1>{{ $task->task_name }}</h1>
	<p>{{ $task->task_body }}</p>
	<div>
		<a href="/projects/{{ $task->project_id }}/tasks/{{ $task->id }}/edit">Edit This Task</a>
	</div>

	<br>

	<div>
		<form method="POST" action="/projects/{{ $task->project_id }}/tasks/{{ $task->id }}/delete">
			@method('DELETE')
			@csrf
			<div>
				<button type="submit">Delete Project</button>
			</div>
		</form>
	</div

@endsection