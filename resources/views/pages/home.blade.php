@extends('layouts.app')

@section('contents')
<div class="col-md-10 offset-md-1 d-flex justify-content-center">
    <div class="card">
        <div class="card-body">
            <a href="{{ route('admin.login') }}" class="btn btn-primary">Go to Admin Panel</a>
            <a href="{{ route('user.bidding_session.index') }}" class="btn btn-secondary">Go to User Panel</a>
        </div>
    </div>
</div>
@endsection
