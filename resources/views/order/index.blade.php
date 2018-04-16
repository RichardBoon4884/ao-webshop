@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Orders</div>
                <div class="card-body">
                    <div class="list-group">
                    @foreach ($orders as $order)
                        <a href="{{ route('viewOrder', ['id' => $order->id]) }}" class="list-group-item">
                            <div>Order: {{ $order->id }}</div>
                        </a>
                    @endforeach

                    @if($orders->count() == 0)
                        There are no orders found.
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
