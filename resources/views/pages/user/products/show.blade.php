@extends('layouts.app')

@section('contents')
<div class="row">
    <div class="col-md-8 offset-md-2 mx-auto">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">
                    {{ $product->title }}
                </h2>

                <div class="card-text table-responsive">
                    @if(session()->has('error'))
                    <div class="alert alert-danger">
                        {{ session()->get('error') }}
                    </div>
                    @elseif(session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                    @endif
                    <form method="POST" action="{{ route('user.product.bid', ['product' => $product->id]) }}" class="col-md-5">
                        @csrf
                        <div class="form-group">
                            @if(!count($bids))
                            <p class="text-info">
                                Minimum price for bidding: {{ $product->minimum_bidding_price ? $product->minimum_bidding_price : "N/A" }}
                            </p>
                            @endif
                            <label>Place a bid</label>
                            <input type="number" class="form-control" name="price">
                            @if($errors->has("price"))
                            <p class="text-danger">{{ $errors->first('price') }}</p>
                            @endif
                        </div>

                        <div class="form-group mt-2">
                            <button class="btn btn-primary">
                                Place a bid
                            </button>
                        </div>
                    </form>

                    <table class="table">
                        <thead>
                            <th>
                                User code
                            </th>
                            <th>
                                Price
                            </th>
                        </thead>

                        <tbody>
                            @if(count($bids))
                            @foreach($bids as $bid)
                            <tr>
                                <td>
                                    {{ $bid->bidder->user_code }}
                                </td>
                                <td>
                                    {{ $bid->price }}
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="12" class="text-center py-5">
                                    Nobody has placed a bid yet!
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endsection
