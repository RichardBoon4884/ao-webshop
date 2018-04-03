@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Product: {{ $product->name }}</div>
                <div class="card-body">

                </div>
            </div>
            <a href="{{ url()->previous() }}">Return</a>
        </div>
    </div>
</div>
@endsection
