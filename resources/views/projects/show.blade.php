@extends('layouts.app')

@section('title', "- $project->project_name")

@section('content')

	<h1>{{ $project->project_name }}</h1>
	<h2>by {{ $project->creator }}</h2>
	<p>{{ $project->description }}</p>

	<a href="/project/tasks/create">Add New Task</a>

	<h3>Project Tasks:</h3>
	<a href="/project/{{ $project->id }}/new">New Tasks</a>
	<a href=""


	@can('update', $project)
		<div>
			<a href="/projects/{{ $project->id }}/edit">Edit This Project</a>
		</div>

		<br>

		<div>
			<form method="POST" action="/projects/{{ $project->id }}">
				@method('DELETE')
				@csrf

				<div>
					<button type="submit">Delete Project</button>
				</div>
			</form>
		</div>
	@endcan

@endsection