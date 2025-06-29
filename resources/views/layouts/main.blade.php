<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> @yield('title') </title>
    <!-- Bootstrap CSS -->
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body class="bg-light">


    <nav class="navbar navbar-expand-sm navbar-dark bg-dark px-3">
        <a class="navbar-brand" href="#">Dashboard</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample03"
            aria-controls="navbarsExample03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-between" id="navbarsExample03">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item ">
                    <a class="nav-link" href="{{ route('dashboard') }}">Home </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="{{ route('cities.index') }}">Cites</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link " href="{{ route('places.index') }}">Places</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="{{ route('rests.index', 1) }}">Restaruants</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="{{ route('hotels.index', 1) }}">Hotels</a>
                </li>


            </ul>
            <a href="{{ route('logout') }}" class="btn btn-light my-2">Log out</a>
        </div>
    </nav>

    <div class="container mt-4">
        @yield('content')
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        function confirmDelete() {
            return confirm('Are you sure you want to delete this City?');
        }
    </script>
</body>

</html>
