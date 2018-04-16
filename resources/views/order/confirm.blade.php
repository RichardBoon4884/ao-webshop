@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Order</div>
                    <div class="card-body">
                        <div class="list-group">
                            @foreach ($shoppingCart->getProducts() as $product)
                                <div class="list-group-item list-group-item-action">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1"><a href="{{ route('productView', ['id' => $product->id, 'slug' => urlencode($product->title)]) }}">{{ $product->title }}</a></h5>
                                        <div>{{ number_format($product->price * $product->amount, 2, ',', ' ') }} EUR</div>
                                    </div>
                                    <div>Amount: {{ $product->amount }}</div>
                                </div>
                            @endforeach
                        </div>
                        <div class="list-group" style="margin-top: 10px">
                            <div class="list-group-item">
                                <h6>Dellivery information:</h6>
                                <div>{{ $client->firstName }} {{ $client->lastName }}</div>
                                <div>{{ $client->street }} {{ $client->houseNumber }}</div>
                                <div>{{ $client->zipCode }} {{ $client->town }}</div>
                                <div>{{ $client->country }}</div>
                            </div>
                        </div>
                        <div class="list-group" style="margin-top: 10px">
                            <div class="list-group-item">
                                <div class="d-flex w-100 justify-content-between">
                                    <a href="{{ route('placeConfirm') }}" class="btn btn-primary" role="button">Confirm order</a>
                                    <div class="text-right">Total: {{ number_format($shoppingCart->getTotalPrice(), 2, ',', ' ') }} EUR</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
