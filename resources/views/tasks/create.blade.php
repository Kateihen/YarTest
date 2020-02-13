@extends('layouts.app')

@section('title', '- Create Task')

@section('content')

    @can('update', $project)
        <h1>Create a New Task</h1>

        <form method="POST" action="/projects/{{ request()->route('id') }}/tasks" enctype="multipart/form-data">
            @csrf

            <div>
                Project ID:
                <br>
                <input type="text" name="project_id" value="{{ request()->route('id') }}" readonly>
            </div>

            <div>
                Task Title:
                <br>
                <input type="text" name="task_name" placeholder="Task Title" value="{{ old('title') }}">
            </div>

            <div>
                Task Status:
                <br>
                <select name="status">
                    <option value="new" selected>New</option>
                    <option value="in_progress">In Progress</option>
                    <option value="done">Done</option>
            </select>

            <div>
                Task Body:
                <br>
                <textarea name="task_body" placeholder="Task body" required>{{ old('description') }}</textarea>
            </div>

            <div>
                Attach a file:
                <input type="file" name="attached_file">
            </div>

            <div>
                <button type="submit">Create Task</button>
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
    @endcan

    @can('view', $project)

        <h4>You must be the creator of the project to add tasks.</h4>
    @endcan

@endsection