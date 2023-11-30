@extends('layouts.app')

@section('contents')
<div class="row">
    <div class="col-md-10 mx-auto">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">
                    Product list
                </h2>
                <a href="{{ route('admin.products.create') }}" class="btn btn-primary btn-sm">Add new</a>

                <div class="card-text table-responsive">
                    <table class="table">
                        <thead>
                            <th>#</th>
                            <th>Title</th>
                            <th>Minimum bidding price</th>
                            <th>Deadline</th>
                        </thead>

                        <tbody>
                            @if(count($products))
                            @foreach($products as $product)
                            <tr>
                                <td>
                                    {{ $product->id }}
                                </td>
                                <td>
                                    {{ $product->title }}
                                </td>
                                <td>
                                    {{ $product->minimum_bidding_price }}
                                </td>
                                <td>
                                    {{ $product->deadline }}
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td class="text-center py-5" colspan="12">No products added yet!</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
