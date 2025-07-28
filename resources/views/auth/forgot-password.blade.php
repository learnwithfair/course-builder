@extends('layouts.auth')

@section('content')
<section class="vh-100 gradient-custom d-flex align-items-center justify-content-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-6 col-xl-5">
                <div class="card shadow-lg bg-dark text-white" style="border-radius: 1rem;">
                    <div class="card-body p-4 p-md-5 text-center">
                        <h2 class="fw-bold mb-3 text-uppercase">Reset Password</h2>
                        <p class="text-white-50 mb-4">Enter your email address to receive password reset instructions.</p>
                        
                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="form-group mb-3">
                                <div class="form-outline form-white">
                                    <input 
                                        type="email" 
                                        name="email" 
                                        id="email" 
                                        class="form-control form-control-lg @error('email') is-invalid @enderror" 
                                        required 
                                        placeholder="Enter your email"
                                    />
                                    <label class="form-label" for="email">Email</label>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" class="btn btn-outline-light btn-lg w-100">Send Reset Link</button>
                        </form>

                        <p class="mt-4 mb-0">
                            <a href="{{ route('login') }}" class="text-white-50 fw-bold">Back to Login</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
