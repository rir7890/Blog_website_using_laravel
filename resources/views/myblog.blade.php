<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Blogs</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        @if (Auth::check())
            <a class="navbar-brand" href="{{ route('dashboard') }}">Dashboard</a>
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
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('all.blogs') }}">All Blogs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('blog.page') }}">create Blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('my.blogs') }}">My Blogs</a>
                    </li>
                </ul>
                <a href="{{ route('logout.user') }}" class=" form-inline my-lg-0 btn btn-outline-success my-2 my-sm-0"
                    type="submit">
                    Logout
                </a>
            </div>
        @endif
    </nav>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
            {{ session('success') }}
        </div>
    @endif


    <div class="container mt-3">
        <h1>My Blogs</h1>
        @if (Auth::check())
            <a href="{{ route('blog.page') }}" class="btn btn-primary my-3">Create New Blog</a>
        @endif
        <div class="row mt-4">
            @foreach ($blogs as $blog)
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <form class="mb-2" method="POST" action="{{ route('blog.edit', $blog->id) }}">
                                @csrf
                                @method('PUT')

                                <div class="form-group row">
                                    <label for="title" class="col-md-4 col-form-label text-md-right">Title</label>

                                    <div class="col-md-6">
                                        <input id="title" type="text"
                                            class="form-control @error('title') is-invalid @enderror" name="title"
                                            value="{{ old('title', $blog->title) }}" required autocomplete="title"
                                            autofocus>

                                        @error('title')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="content">Content</label>
                                    <textarea class="form-control @error('content') is-invalid  @enderror" id="content" name="content" rows="5">{{ $blog->description }}</textarea>
                                    @error('content')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Add more fields as needed -->
                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            Edit Profile
                                        </button>
                                    </div>
                                </div>
                            </form>

                            <a href="{{ route('blog.show', $blog->id) }}" class="btn btn-primary">Read More</a>
                            <form action="{{ route('blog.destroy', $blog->id) }}" method="POST"
                                class="d-inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Bootstrap JS, jQuery, and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
