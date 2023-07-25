@extends('layouts.auth.main')

@section('title', 'Login')

{{-- @section('contents')
    <main>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <div class="card shadow-lg border-0 rounded-lg mt-5">
                        <div class="card-header">
                            <h3 class="text-center font-weight-light my-4">Login</h3>
                        </div>
                        <div class="card-body">

                            @include('partials.alerts')

                            <form action="{{ route('login') }}" method="POST">
                                @csrf
                                <div class="form-floating mb-3">
                                    <input class="form-control @error('email') is-invalid @enderror" id="email"
                                        name="email" type="email" placeholder="name@example.com"
                                        value="{{ old('email') }}">
                                    <label for="email">Email address</label>

                                    @error('email')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-floating mb-3">
                                    <input class="form-control @error('password') is-invalid @enderror" id="password"
                                        name="password" type="password" placeholder="Password">
                                    <label for="password">Password</label>

                                    @error('password')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="d-flex align-items-center justify-content-center mt-4 mb-0">
                                    <input type="submit" value="Login" class="btn btn-primary">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection --}}

<body>
    @include('partials.alerts')
    <div class="signin  bg-body shadow">
        <div class="back-img">


            <!--/.sign-in-text-->
            <div class="layer">
            </div>
            <!--/.layer-->
            <p class="point">&#9650;</p>
        </div>
        <!--/.back-img-->
        <div class="form-section">
            <h2 class="active text-black" style="margin-left: 73px">Sign In</h2>

            <form action="{{ route('login') }}" method="POST">
                <!--Email-->
                @csrf
                <div class="form-floating mb-1">
                    <input class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                        type="email" placeholder="name@example.com" value="{{ old('email') }}">
                    <label for="email">Email address</label>
                    @error('email')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <!--Password-->
                <div class="form-floating">
                    <input class="form-control @error('password') is-invalid @enderror" id="password" name="password"
                        type="password" placeholder="Password">
                    <label for="password">Password</label>

                    @error('password')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <br />
                <div class="row">
                    <p class="">Not Registered? <a href="{{ route('register') }}">Register</a></p>
                </div>


                <div class="row"> <input type="submit" value="Login" class="btn btn-primary"> </div>
            </form>
        </div>
        <!--/.form-section-->

        <!--/button-->
    </div>
    <!--/.signin-->
</body>
