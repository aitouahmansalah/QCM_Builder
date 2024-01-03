<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'QCM Web App')</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body style="height: 100vh">

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="/">QCM</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('exams.index') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-link nav-link">Logout</button>
                        </form>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

    <div class="container-fluid ">
        <div class="row" style="height : 100vh">
        <aside class="sidebar bg-dark ms-3" style="width: 150px" >
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link active m-2" href="{{ route('exams.index') }}">
                Dashboard
            </a>
        </li>
        <li class="nav-item m-2">
            <a class="nav-link" href="{{ route('exams.index') }}">
                Exams
            </a>
        </li>
        <li class="nav-item m-2">
            <a class="nav-link" href="{{ route('exams.result') }}">
                Results
            </a>
        </li>
    </ul>
</aside>

<h2>Available Exams</h2>

@foreach($exams as $exam)
    <div class="col-md-4 mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $exam->title }}</h5>
                <p class="card-text">{{ $exam->description }}</p>
                <a href="{{ route('exams.pass', $exam->id) }}" class="btn btn-primary">Pass Exam</a>
            </div>
        </div>
    </div>
@endforeach
</div>

    </div>
    </div>
</body>
</html>







