@extends('layout.main')

@section('title', 'Login')

@section('css')
<style>
    .divider:after,
.divider:before {
content: "";
flex: 1;
height: 1px;
background: #eee;
}
.h-custom {
height: calc(100% - 73px);
}
@media (max-width: 450px) {
.h-custom {
height: 100%; 
}
}
</style>
@endsection

@section('content')
<section class="vh-100">
  <div class="container-fluid h-custom">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-md-9 col-lg-6 col-xl-5">
        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp"
          class="img-fluid" alt="Sample image">
      </div>
      <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
        <form method="POST" action="/register">
            @csrf
          <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
            <p class="lead fw-normal mb-0 me-3">Sign in with</p>
            <button type="button" class="btn btn-primary btn-floating mx-1">
              <i class="fab fa-facebook-f"></i>
            </button>

            <button type="button" class="btn btn-primary btn-floating mx-1">
              <i class="fab fa-twitter"></i>
            </button>

            <button type="button" class="btn btn-primary btn-floating mx-1">
              <i class="fab fa-linkedin-in"></i>
            </button>
          </div>

          <div class="divider d-flex align-items-center my-4">
            <p class="text-center fw-bold mx-3 mb-0">Or</p>
          </div>
          @error('email')
              <div class="alert alert-danger" role="alert">
                  {{ $message }}
              </div>
              
          @enderror
          {{-- Name input --}}
          <div class="form-outline mb-4">
            <input id="form3Example3" class="form-control form-control-lg"
              placeholder="Enter a valid email address" name="name" />
            <label class="form-label" for="form3Example3">Name</label>
          </div>

          <!-- Email input -->
          <div class="form-outline mb-4">
            <input type="email" id="form3Example3" class="form-control form-control-lg"
              placeholder="Enter a valid email address" name="email" />
            <label class="form-label" for="form3Example3">Email address</label>
          </div>

          <!-- Address input -->
          <div class="form-outline mb-4">
            <input id="form3Example3" class="form-control form-control-lg"
              placeholder="Enter a valid email address" name="address" />
            <label class="form-label" for="form3Example3">Address</label>
          </div>

          <!-- Phone input -->
          <div class="form-outline mb-4">
            <input  id="form3Example3" class="form-control form-control-lg"
              placeholder="Enter a valid email address" name="phone" />
            <label class="form-label" for="form3Example3">Phone</label>
          </div>

          <!-- Password input -->
          <div class="form-outline mb-3">
            <input type="password" id="form3Example4" class="form-control form-control-lg"
              placeholder="Enter password" name="password" />
            <label class="form-label" for="form3Example4">Password</label>
          </div>
          
          <!-- Confirm Password input -->
          <div class="form-outline mb-3">
            <input type="password" id="form3Example4" class="form-control form-control-lg"
              placeholder="Enter password" name="password_confirmation" />
            <label class="form-label" for="form3Example4">Confirm Password</label>
          </div>



          <div class="text-center text-lg-start mt-4 pt-2">
            <button type="submit" class="btn btn-primary btn-lg"
              style="padding-left: 2.5rem; padding-right: 2.5rem;">Register</button>
            <p class="small fw-bold mt-2 pt-1 mb-0">Already have an account? <a href="/login"
                class="link-danger">Login</a></p>
          </div>

        </form>
      </div>
    </div>
  </div>
</section>
@endsection