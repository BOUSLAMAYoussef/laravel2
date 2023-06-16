@extends('layout/layout-common')

@section('space-work')
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h1>Login</h1>

                @if($errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                            <p>{{$error}}</p>
                        @endforeach
                    </div>
                @endif

                @if(Session::has('error'))
                    <div class="alert alert-danger">
                        {{ Session::get('error') }}
                    </div>
                @endif

                <form action="{{ route('userLogin') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Enter Email">
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Enter Password">
                    </div>

                    <button type="submit" class="btn btn-primary">Login</button>
                </form>
                
                <div class="text-center mt-3">
                    <p>Don't have an account? <a href="{{ route('loadRegister') }}">Register</a></p>
                </div>
            </div>
        </div>
    </div>
@endsection
