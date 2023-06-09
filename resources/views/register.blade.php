@extends('layout/layout-common')

@section('space-work')
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h1>Register</h1>

                @if($errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                            <p>{{$error}}</p>
                        @endforeach
                    </div>
                @endif
 
                <form action="{{ route('studentRegister') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter Name">
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Enter Email">
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Enter Password">
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Confirm Password</label>
                        <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password">
                    </div>

                    <button type="submit" class="btn btn-primary">Register</button>
                </form>

                @if(Session::has('success'))
                    <p style="color:green;">{{ Session::get('success') }}</p>
                @endif
            </div>
        </div>
    </div>
@endsection
