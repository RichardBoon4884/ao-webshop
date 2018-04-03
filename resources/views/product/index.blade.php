@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Products</div>
                @foreach ($products as $product)
                    <div class="card-body">
                        <p>Product: {{ $product->name }}</p>
                    </div>
                @endforeach

                @if (is_null($products))
                    <div class="card-body">
                        No products
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
