@extends('layouts.app')

@section('contents')
<div class="row d-flex justify-content-center">
    <div class="col-md-6 md-offset-3">
        <div class="card p-2">
            <h2 class="card-title">Admin Login</h2>

            <div class="card-body">
                @if(session()->has('error'))
                <div class="alert alert-danger">{{ session()->get('error') }}</div>
                @endif

                <form action="{{ route('admin.login.post') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" name="email" class="form-control">
                        @if($errors->has('email'))
                        <p class="text-danger">{{ $errors->first('email') }}</p>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control">
                        @if($errors->has('password'))
                        <p class="text-danger">{{ $errors->first('password') }}</p>
                        @endif
                    </div>

                    <div class="form-group mt-2">
                        <button class='btn btn-success'>Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
