@extends("layouts.app")

@section('contents')
<div class="row">
    <div class="col-md-4 offset-md-4 mx-auto">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">
                    Start a bidding session
                </h2>

                <div class="card-text">
                    @if(session()->has('success'))
                    <div class="alert-success">
                        {{ session()->get('success') }}
                    </div>
                    @elseif(session()->has('error'))
                    <div class="alert-error">
                        {{ session()->get('error') }}
                    </div>
                    @endif
                    <form method="POST" action="{{ route('user.bidding_session.send_magic_link') }}">
                        @csrf
                        <div class="form-group">
                            <label>
                                Enter your email
                            </label>
                            <input type="text" class="form-control" name="email">
                            @if($errors->has('email'))
                            <p class="text-danger">{{ $errors->first('email') }}</p>
                            @endif
                        </div>
                        <div class="form-group mt-2">
                            <button class="btn btn-primary">
                                Start
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
