@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Products</div>
                    <div class="card-body">
                        <div class="list-group">
                            @foreach ($products as $product)
                                <a href="{{ route('productView', ['id' => $product->id, 'slug' => urlencode($product->name)]) }}" class="list-group-item">
                                    <div>{{ $product->name }}</div>
                                    <div>

                                    </div>
                                </a>
                            @endforeach

                            @if($products->count() == 0)
                                There are no products in your shopping cart.
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
