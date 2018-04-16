@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Order</div>
                    <div class="card-body">
                        <div class="list-group">
                            @foreach ($order->products as $product)
                                <div class="list-group-item list-group-item-action">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1"><a href="{{ route('productView', ['id' => $product->id, 'slug' => urlencode($product->title)]) }}">{{ $product->title }}</a></h5>
                                        <div>{{ number_format($product->price * $product->pivot->amount, 2, ',', ' ') }} EUR</div>
                                    </div>
                                    <div>Amount: {{ $product->pivot->amount }}</div>
                                </div>
                            @endforeach
                        </div>
                        <div class="list-group" style="margin-top: 10px">
                            <div class="list-group-item">
                                <h6>Dellivery information:</h6>
                                <div>{{ $order->client->firstName }} {{ $order->client->lastName }}</div>
                                <div>{{ $order->client->street }} {{ $order->client->houseNumber }}</div>
                                <div>{{ $order->client->zipCode }} {{ $order->client->town }}</div>
                                <div>{{ $order->client->country }}</div>
                            </div>
                        </div>
                        <div class="list-group" style="margin-top: 10px">
                            <div class="list-group-item">
                                <div class="d-flex w-100 justify-content-between">
                                    <div></div>
                                    <div class="text-right">Total: {{ number_format($order->totalPrice, 2, ',', ' ') }} EUR</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
