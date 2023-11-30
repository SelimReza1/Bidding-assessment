@extends('layouts.app')

@section('contents')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">
                    Create a product
                </h2>

                <div class="card-text">
                    <form method="POST" action="{{ route('admin.products.store') }}">
                        @csrf

                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control">
                            @if($errors->has('title'))
                            <p class="text-danger">{{ $errors->first('title') }}</p>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Minimum bidding price</label>
                            <input type="number" name="minimum_bidding_price" class="form-control">
                            @if($errors->has('minimum_bidding_price'))
                            <p class="text-danger">{{ $errors->first('minimum_bidding_price') }}</p>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Deadline</label>
                            <input type="datetime-local" name="deadline" class="form-control">
                            @if($errors->has('deadline'))
                            <p class="text-danger">{{ $errors->first('deadline') }}</p>
                            @endif
                        </div>

                        <div class="form-group mt-2">
                            <button class="btn btn-primary">
                                Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endsection
