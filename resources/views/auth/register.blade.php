{{-- <h1>Register</h1>

<form action="{{route('register')}}" method="post">
    @csrf

    <input type="text" name="name" id="">
    @error('name')
        {{$message}}
    @enderror
    <input type="email" name="email" id="">
    @error('email')
        {{$message}}
    @enderror
    <input type="text" name="referal_code" id="" value=" ">

    <input type="password" name="password" id="">
    @error('password')
        {{$message}}
    @enderror

    <input type="password" name="password_confirmation" id="">
   

    <input type="submit" value="Connxion">

</form> --}}



@extends('layouts.authent')

@section('title', 'Inscription')
@section('content')
   

<div class="authincation">
    <div class="container">
        <div class="row justify-content-center align-items-center g-0">
            <div class="col-xl-8">
                <div class="row g-0">
                    <div class="col-lg-6">
                        <div class="welcome-content">
                            <div class="welcome-title">
                                <div class="mini-logo">
                                    <a href="index.html">
                                        <img src="images/logo-white.png" alt="" width="30" /></a>
                                </div>
                                <h3>Bienvenue à Upflow</h3>
                            </div>
                            {{-- <div class="privacy-social">
                                <div class="privacy-link"><a href="signup.html#">Have an issue with 2-factor
                                        authentication?</a><br /><a href="signup.html#">Privacy Policy</a></div>
                                <div class="intro-social">
                                    <ul>
                                        <li><a href="signup.html#"><i class="fi fi-brands-facebook"></i></a></li>
                                        <li><a href="signup.html#"><i class="fi fi-brands-twitter-alt"></i></a></li>
                                        <li><a href="signup.html#"><i class="fi fi-brands-linkedin"></i></a></li>
                                        <li><a href="signup.html#"><i class="fi fi-brands-pinterest"></i></a></li>
                                    </ul>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="auth-form">
                            <h4>Inscription</h4>
                            <form  action="{{route('register')}}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <label class="form-label">Non</label>
                                        <input name="name" id='name' type="text" class="form-control" />  
                                        @error('name')
                                          <p class="text-sm text-red">{{$message}}</p>
                                         @enderror

                                    </div>

                                    <div class="col-12 mb-3">
                                        <label class="form-label">Email</label>
                                        <input name="email" type="text" class="form-control" />
                                        @error('email')
                                        <p class="text-sm text-red">{{$message}}</p>
                                       @enderror
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label class="form-label">Code de Parainage</label>
                                        <input name="referal_code" type="text" class="form-control" />
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label class="form-label">Password</label>
                                        <input name="password" type="password" class="form-control" />
                                        @error('password')
                                        {{$message}}
                                    @enderror
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label class="form-label">Confrimer votre Mots de Pasee</label>
                                        <input name="password_confirmation" type="password" class="form-control" />
                                        @error('password_confirmation')
                                        {{$message}}
                                    @enderror
                                    </div>
                                </div>
                                <div class="mt-3 d-grid gap-2"><button type="submit" class="btn btn-primary me-8 text-white">Sign Up</button></div>
                            </form>
                            <p class="mt-3 mb-0 undefined">Already have an account?<a class="text-primary" href="{{ url('/') }}"> Connectez-vous</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@if (Session::has('success'))
    {{Session::get('success')}}
@endif

@if (Session::has('error'))
    {{Session::get('error')}}
@endif
@endsection