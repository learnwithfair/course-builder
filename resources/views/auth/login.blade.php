@extends('layouts.auth')

@section('content')
<section class="vh-100 gradient-custom d-flex align-items-center justify-content-center">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-10 col-lg-6 col-xl-5">
        <div class="text-white shadow-lg card bg-dark" style="border-radius: 1rem;">
          <div class="p-4 text-center card-body p-md-5">

            <div class="mb-4">
              <h2 class="mb-3 fw-bold text-uppercase">Login</h2>
              <p class="text-white-50">Access your account to manage your tasks efficiently.</p>
            </div>

            <form method="POST" action="{{ route('login') }}">
              @csrf
              <div class="mb-3 form-group">
                <div class="form-outline form-white">
                  <label class="form-label" for="typeEmailX">Email</label>
                  <input 
                    type="email" 
                    name="email" 
                    id="typeEmailX" 
                    class="form-control form-control-lg @error('email') is-invalid @enderror" 
                    required 
                    placeholder="Enter your email"
                  />
                  @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>

              <div class="mb-3 form-group">
                <div class="form-outline form-white">
                  <label class="form-label" for="typePasswordX">Password</label>
                  <input 
                    type="password" 
                    name="password" 
                    id="typePasswordX" 
                    class="form-control form-control-lg @error('password') is-invalid @enderror" 
                    required 
                    placeholder="Enter your password"
                  />
                  @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>

              <div class="mb-4 d-flex justify-content-between align-items-center">
              <a href="{{ route('password.request') }}" class="text-white-50 small">Forgot password?</a>
              </div>

              <button type="submit" class="btn btn-outline-light btn-lg w-100">Login</button>
            </form>

            <div class="mt-4 d-flex justify-content-center align-items-center">
              <a href="#" class="mx-2 text-white"><i class="fab fa-facebook-f fa-lg"></i></a>
              <a href="#" class="mx-2 text-white"><i class="fab fa-twitter fa-lg"></i></a>
              <a href="#" class="mx-2 text-white"><i class="fab fa-google fa-lg"></i></a>
            </div>

            <p class="mt-4 mb-0">Don't have an account? 
              <a href="{{ route('register') }}" class="text-white-50 fw-bold">Sign Up</a>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection