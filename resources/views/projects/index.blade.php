@extends('layouts.app')

@section('title', '- Projects')

@section('content')

    <h1>Projects</h1>
    @foreach($projects as $project)
        <ul>
            <li>
            
                <h4>{{ $project->project_name }}</h4> by 
                <b>{{ $project->creator }}</b>
                <br>
                <div>
                    <br>
                    "{{ str_limit($project->description, $limit = 50, $end = '...') }}"
                    <a href="/projects/{{ $project->id }}">Read more</a>
                <div>
            </li>
        </ul>
    @endforeach

    {{ $projects->links() }}

@endsection