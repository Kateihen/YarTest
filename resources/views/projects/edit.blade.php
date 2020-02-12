@extends('layouts.app')

@section('title', '- Edit Project')

@section('content')

    <h1 class="title">Edit Project</h1>

    <form method="POST" action="/projects/{{ $project->id }}">
        @method('PATCH')
        @csrf

        <div>
            Title:
            <br>
            <input type="text" name="project_name" value="{{ $project->project_name }}" required>
        </div>

        <div>
            Author:
            <br>
            <input type="text" name="author" value="{{ $project->creator }}" readonly>
        </div>
        <div>
            Project Description:
            <br>
            <textarea name="description" required>{{ $project->description }}</textarea>
        </div>

        <div>
            <button type="submit">Update Project</button>
        </div>
    </form>

    <form method="POST" action="/projects/{{ $project->id }}">
        @method('DELETE')
        @csrf

        <div>
            <button type="submit">Delete Project</button>
        </div>
    </form>

    @if ($errors->any())
        <div>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

@endsection