<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="{{ route('dashboard') }}">BLOG WEB</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                @if (Auth::user()->role == 1)
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.dashboard') }}">Admin Page</a>
                    </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('all.blogs') }}">All Blogs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('blog.page') }}">create Blog</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('my.blogs') }}">My Blogs</a>
                </li>

            </ul>

            <a href="{{ route('logout.user') }}" class=" form-inline my-lg-0 btn btn-outline-danger my-2 my-sm-0"
                type="submit">
                Logout
            </a>
        </div>
    </nav>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
            {{ session('error') }}
        </div>
    @endif

    <div class="container mt-4">
        <h2 class="text-center">Welcome to your Dashboard</h2>
        <!-- Dashboard content goes here -->
        <div class="container mt-4">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-header text-center">
                            Dashboard
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 text-center">
                                    <img src="{{ asset(Auth::user()->image) }}" class="img-fluid"
                                        style="height: 200px;weight:100px;" alt="User Image">
                                </div>
                                <div class="col-md-8 text-center mt-4">
                                    <h3>{{ Auth::user()->name }}</h3>
                                    <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                                    <p><strong>Phone:</strong> {{ Auth::user()->phone }}</p>
                                    <!-- Add more user information as needed -->
                                </div>
                            </div>
                        </div>
                        <div class="col mt-2 text-center mb-3">
                            <a href="{{ route('profile.edit') }}" class="btn btn-primary">Edit
                                Profile</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS, jQuery, and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
