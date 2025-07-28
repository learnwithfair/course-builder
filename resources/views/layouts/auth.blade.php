<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">

    <style>
        body {
            background: linear-gradient(135deg, #4a90e2, #9013fe);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Roboto', sans-serif !important;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="text-white card bg-dark" style="border-radius: 1rem;">
                    <div class="p-5 card-body">
                        <h2 class="mb-2 text-uppercase fw-bold">Login Here</h2>
                        <p class="mb-4 text-white-50">Access your account to manage your tasks efficiently.</p>

                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="mb-4 form-outline form-white">
                                <label class="form-label" for="typeEmailX">Email</label>
                                <input type="email" name="email" id="typeEmailX"
                                    class="form-control  @error('email') is-invalid @enderror" required
                                    placeholder="Enter your email" />
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4 form-outline form-white">
                                <label class="form-label" for="typePasswordX">Password</label>
                                <input type="password" name="password" id="typePasswordX"
                                    class="form-control  @error('password') is-invalid @enderror" required
                                    placeholder="Enter your password" />
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="mt-3 btn btn-outline-light btn-lg w-100">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
