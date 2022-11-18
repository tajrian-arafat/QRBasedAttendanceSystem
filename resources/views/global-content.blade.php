<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
</head>
<style>

</style>
@yield('styles')

<body class="container" style="padding:30px; background-color:#d2d6d3!important;">
    <nav class="navbar navbar-expand-lg navbar-light bg-light" style="background-color:#bec2bf!important;">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="btn btn-success" href="#">Home</span></a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-danger" href="#">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    @yield('content')


</body>
</html>

<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
@yield('scripts')
