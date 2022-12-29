@extends('layouts.main')

<style>
  body {
    background-image: url(http://127.0.0.1:8000/css/post2.jpg);
    border-radius: 50px;
}
  </style>

@section('container')
<div class="row justify-content-center">
  <div class="col-md-5">

  @if(session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{session('success')}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
   </div>
   @endif

   @if(session()->has('loginError'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      {{session('loginError')}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
   </div>
   @endif


    <main class="form-signin">
      <h1 style="color:aliceblue" class="h3 mb-3 font-weight-normal text-center">Login Form</h1>
    <form action="/login" method="post">
      @csrf
        <div class="form-floating">
        <input type="email"  name="email"class="form-control @error('email')is-invalid @enderror" placeholder="Email" width="40% mb-lg-5" autofocus required>
         <label for="email">Email Address</label>
          @error('email')
         <div class="invalid-feedback" style="color:aliceblue">
          {{$message}}
         </div>
        @enderror
        </div> 

        <div class="form-floating">
         <input type="password"  name="password"class="form-control" placeholder="Password" width="40% pd-4" required >
        <label for="password">Password</label>
        </div> 

        <br>
        <button type="submit" class="w-100 btn-lg  btn-primary">
          Login
        </button>
     <form>
      <small style="color:aliceblue" class="d-block text-center mt-4">Not registered? <a href="/register">Register Now!</a></small>
     </main>
  </div>
</div>

@endsection