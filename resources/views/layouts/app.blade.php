<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>YarindinTest @yield('title')</title>
</head>

<body>

    <div>
        @yield('content')
    </div>

    @if(Auth::check())
        <div>
            <form action="/logout" method="POST">
                @csrf
                <button value="submit">Logout</button>
            </form>
        </div>

    @endif

</body>
</html>


