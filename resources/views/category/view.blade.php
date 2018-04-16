@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Category: {{ $category->title }}</div>
                <div class="card-body">
                    <div>
                        @foreach ($category->products as $product)
                            <a href="{{ route('productView', ['id' => $product->id, 'slug' => urlencode($product->title)]) }}" class="list-group-item">
                                <div>{{ $product->title }}</div>
                                <div>
                                    Categories:
                                    @foreach ($product->categories as $category)
                                        {{ $category->title }},
                                    @endforeach
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
            <a href="{{ url()->previous() }}">Return</a>
        </div>
    </div>
</div>
@endsection
