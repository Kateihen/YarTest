@extends('layouts.app')

@section('title', "- $project->project_name")

@section('content')

    <h1>{{ $project->project_name }}</h1>
    <h2>by {{ $project->creator }}</h2>
    <p>{{ $project->description }}</p>

        <ul><h3>Project Tasks:</h3>
            <li><a href="/projects/{{ $project->id }}/new">New</a><br></li>
            <li><a href="/projects/{{ $project->id }}/in_progress">In Progress</a><br></li>
            <li><a href="/projects/{{ $project->id }}/done">Done</a><br></li>
        </ul>

    @can('update', $project)
        <a href="/projects/{{ $project->id }}/tasks/create">Add New Task</a>


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