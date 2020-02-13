@extends('layouts.app')

@section('title', '- Edit Task')

@section('content')

    <h1 class="title">Edit Task</h1>

    <form method="POST" action="/projects/{{ $task->project_id }}/tasks/{{ $task->id }}">
        @method('PATCH')
        @csrf

        <div>
            Project ID:
            <br>
            <input type="text" name="project_id" value="{{ $task->project_id }}" readonly>
        </div>

        <div>
            Task Title:
            <br>
            <input type="text" name="task_name" value="{{ $task->task_name }}" required>
        </div>

        <div>
            Task Status:
            <br>
            <select name="status">
                <option value="new">New</option>
                <option value="in_progress" selected>In Progress</option>
                <option value="done">Done</option>
            </select>
        <div>

            Task Body:
            <br>
            <textarea name="task_body" required>{{ $task->task_body }}</textarea>
        </div>

        <div>
            <button type="submit">Update Project</button>
        </div>
    </form>

    <form method="POST" action="/projects/{{ $task->project_id }}/tasks/{{ $task->id }}/delete">
        @method('DELETE')
        @csrf

        <div>
            <button type="submit">Delete Task</button>
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