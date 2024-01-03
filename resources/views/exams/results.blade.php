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
    <div class="container-fluid">
        <div class="row" style="height: 100vh">
            <div class="col-2">
                <aside class="sidebar bg-dark ms-3" style="width: 150px;height: 100vh">
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
            </div>
            <div class="col-10">
                <div class="container mt-4">
                    <h2>Exam Results</h2>
                    <div class="row table-responsive">
                        <table class="table table-dark table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Exam Title</th>
                                    <th scope="col">Score</th>
                                    <th scope="col">Pass/Fail</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($results as $result)
                                    <tr>
                                        <td>{{ $result->exam->title }}</td>
                                        <td>{{ $result->score }}%</td>
                                        <td>{{ ($result->score > 50) ? 'Pass' : 'Fail' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
