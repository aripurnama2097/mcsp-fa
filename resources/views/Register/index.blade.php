@extends('layouts.main')

<style>
  body {
    background-image: url(http://127.0.0.1:8000/css/post2.jpg);
    border-radius: 50px;
}
  </style>

@section('container')
<div class="row justify-content-center">
  <div class="col-lg-5">
    <main class="form-registration">
      <h1 style="color:aliceblue" class="h3 mb-3 font-weight-normal text-center">Register Form</h1>
     <form action="/register" method="post">
      @csrf
      <div class="form-floating">
      <input type="text" name="name" id="name"class="form-control rounded-top @error('name')is-invalid @enderror" placeholder="Name" required value="{{old('name')}} " autofocus>
        <label for="name">Name</label>
        @error('name')
         <div class="invalid-feedback" style="color:aliceblue">
          {{$message}}
         </div>
        @enderror
      </div> 

       <div class="form-floating">
        <input type="text" name="nik" id="nik"class="form-control rounded-top @error('nik')is-invalid @enderror" placeholder="NIK" required value="{{old('nik')}}">
         <label for="nik">NIK</label>
         @error('nik')
         <div class="invalid-feedback">
            {{$message}}
          </div>
        @enderror
       </div> 

        <div class="form-floating">
          <input type="text" name="dept" id="dept"class="form-control rounded-top @error('dept')is-invalid @enderror" placeholder="Department" required value="{{old('dept')}}">
          <label for="dept">Department</label>
          @error('dept')
         <div class="invalid-feedback">
           {{$message}}
          </div>
           @enderror
        </div> 

        <div class="form-floating">
         <input type="email" name="email"class="form-control @error('email')is-invalid @enderror" placeholder="Email" required value="{{old('email')}}">
         <label for="email">Email Address</label>
           @error('email')
         <div class="invalid-feedback">
            {{$message}}
          </div>
           @enderror
        </div> 
        <div class="form-floating">
         <input type="password" name="password"class="form-control @error('password')is-invalid @enderror" placeholder="Password" required>
         <label for="floatingPassword">Password</label>
         @error('password')
         <div class="invalid-feedback">
            {{$message}}
          </div>
           @enderror
        </div>
        <br>
        <button type="submit" class="w-100 btn-lg  btn-primary">
         Register
        </button>
      </form>
      <small class="d-block text-center mt-4"> <a href="/login">Back</a></small>
     </main>
  </div>
</div>

@endsection