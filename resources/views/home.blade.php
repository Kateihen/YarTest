@extends('layouts.app')

@section('title', '- MyProjects')

@section('content')
    <a href='/projects/create'>Create A New Project</a>

    <h1>My Projects</div>

    <div>
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
 </div>

@endsection
