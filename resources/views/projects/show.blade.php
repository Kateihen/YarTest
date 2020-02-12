@extends('layouts.app')

@section('title', "- $project->title")

@section('content')

    <h1>{{ $project->project_name }}</h1>
    <h2>by {{ $project->creator }}</h2>
    <p>{{ $project->description }}</p>

    @can('update', $project)
        <div>
            <a href="/projects/{{ $project->id }}/edit">Edit This project</a>
        </div>

        <br>

        <div>
            <form method="POST" action="/projects/{{ $project->id }}">
                @method('DELETE')
                @csrf

                <div>
                    <button type="submit">Delete Post</button>
                </div>
            </form>
        </div>
    @endcan

@endsection