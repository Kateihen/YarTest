@extends('layouts.app')

@section('title', "- $status")

@section('content')

    <h1>Tasks</h1>
    @if($tasks)
        <ul>
        @foreach($tasks as $task)
                <li>
                    <a href="/projects/{{ $task->project_id}}/{{ $status }}/{{ $task->id }}">
                    {{ $task->task_name }}
                    </a>
                </li>
        @endforeach
        </ul>
    @else
        <h3>No Tasks Yet</h3>
    @endif

@endsection