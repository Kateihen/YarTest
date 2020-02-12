@extends('layouts.app')

@section('content')
    <div>
        <h1>Welcome!</h1>
    </div>

    <div>
        @yield('content')
    </div>

    <div>
        @if(Auth::check())
        <ul>
            <li><a href="/home">My Projects</a>
            <li><a href="/projects/create">Create a New Project</a></li>
        </ul>

        <div>
            <form action="/logout" method="POST">
                @csrf
                <button value="submit">Logout</button>
            </form>
        </div>

        @endif

        @if(!Auth::check())
            <h2>Please, register to continue.</h2>
            <a href="/register"><h3>Register</h3></a>

            <h2>Have an account?</h2>
            <a href="/login"><h3>Login</h3></a>

        @endif
    </div>
@endsection
