<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles -->
    <style>
        .form-signup {
            max-width: 400px;
            margin: auto;
            margin-top: 50px;
        }

        .image-preview {
            width: 200px;
            height: 200px;
            border: 2px solid #ddd;
            border-radius: 5px;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            margin-top: 10px;
        }

        .image-preview img {
            max-width: 100%;
            max-height: 100%;
            display: block;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light h-25">
        <a class="navbar-brand" href="/">BLOG WEB</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">Register</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('loginPage') }}">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('all.blogs') }}">Blogs</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container p-4">
        <form class="form-signup" method="POST" action="{{ route('register.user') }}" enctype="multipart/form-data">
            @csrf
            <h2 class="text-center">Registration</h2>
            <div class="form-group">
                <label for="inputUsername">Username</label>
                <input type="text" id="inputUsername" name="name"
                    class="form-control @error('name') is-invalid  @enderror" placeholder="Enter username.." autofocus>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="inputEmail">Email address</label>
                <input type="email" name="email" id="inputEmail"
                    class="form-control @error('email') is-invalid @enderror" placeholder="Enter email..">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="inputPhoneNumber">Phone Number</label>
                <input type="text" id="inputPhoneNumber" name="phone"
                    class="form-control @error('phone') is-invalid @enderror" placeholder="Enter the Phone Number..">
                @error('phone')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="image">Choose Image</label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="image" name="image"
                        onchange="previewImage()">
                    <label class="custom-file-label" for="image">Choose file</label>
                </div>
            </div>

            <div class="form-group">
                <label for="inputPassword">Password</label>
                <input type="password" id="inputPassword" name="password"
                    class="form-control @error('password') is-invalid @enderror">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="inputConfirmPassword">confirm Password</label>
                <input type="password" id="inputConfirmPassword" name="password_confirmation"
                    class="form-control @error('password_confirmation') is-invalid @enderror">
                @error('password_confirmation')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
        </form>
    </div>
    <!-- Bootstrap JS, jQuery, and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Custom JavaScript for image preview -->
    <script>
        function previewImage() {
            var preview = document.getElementById('previewImage');
            var file = document.getElementById('image').files[0];
            var reader = new FileReader();

            reader.onloadend = function() {
                preview.src = reader.result;
            }

            if (file) {
                reader.readAsDataURL(file);
                document.getElementById('imagePreview').style.display = "block";
            } else {
                preview.src = "";
                document.getElementById('imagePreview').style.display = null;
            }
        }
    </script>
</body>

</html>
