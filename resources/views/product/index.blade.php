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
                        </a>
                    @endforeach
                    </div>
                </div>
            </div>

        @if (is_null($products))
            <div class="card">
                <div class="card-header">Products</div>
                <div class="card-body">
                    There are no products found. Maybe create one?
                </div>
            </div>
        @endif
        </div>
    </div>
</div>
@endsection
