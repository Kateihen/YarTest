@extends('layouts.app')

@section('title', '- Create Project')

@section('content')

    <h1>Create a New Project</h1>

    <form method="POST" action="/projects">
        @csrf

        <div>
            Title:
            <br>
            <input type="text" name="project_name" placeholder="Project Title" value="{{ old('title') }}">
        </div>

        <div>
            Author:
            <br>
            <input type="text" name="creator" value="{{ Auth::user()->name }}" readonly>
        </div>

        <div>
            Project Description:
            <br>
            <textarea name="description" placeholder="Project description" required>{{ old('description') }}</textarea>
        </div>

        <div>
            <button type="submit">Create Project</button>
        </div>

        @if ($errors->any())

            <div>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>

        @endif

    </form>

@endsection