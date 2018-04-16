@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Shopping cart</div>
                    <div class="card-body">
                        <div class="list-group">
                            @foreach ($shoppingCart->products as $product)
                                <div class="list-group-item list-group-item-action">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1"><a href="{{ route('productView', ['id' => $product->id, 'slug' => urlencode($product->title)]) }}">{{ $product->title }}</a></h5>
                                        <div>{{ number_format($product->price * $product->amount, 2, ',', ' ') }} EUR</div>
                                    </div>
                                    <div>
                                        {{ Form::open(['method' => 'put', 'route' => ['shoppingCartUpdate', $product->id], 'class' => 'form-inline']) }}
                                        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                            <div class="input-group-prepend">
                                                {{ Form::label('amount', 'Amount', ['class' => 'input-group-text']) }}
                                            </div>
                                            {{ Form::number('amount', $product->amount, ['class' => 'form-control'] ) }}
                                        </div>
                                        {{ Form::submit('Update', ['class' => 'btn btn-primary']) }}
                                        <a href="{{ route('shoppingCartUpdate', ['productId' => $product->id, 'amount' => 0]) }}" class="btn btn btn-danger" role="button">Remove</a>
                                        {{ Form::close() }}
                                    </div>
                                </div>
                            @endforeach

                            @if(count($shoppingCart->products) == 0)
                                <div class="list-group-item">
                                    There are no products in your shopping cart.
                                </div>
                            @endif
                        </div>
                        <div class="list-group" style="margin-top: 10px">
                            <div class="list-group-item">
                                <div class="d-flex w-100 justify-content-between">
                                    @if(count($shoppingCart->products) != 0)
                                        <a href="{{ route('orderConfirm') }}" class="btn btn-primary" role="button">Order</a>
                                    @else
                                        <a href="#" class="btn btn-outline-primary disabled" role="button">Order</a>
                                    @endif
                                    <div class="text-right">Total: {{ number_format($shoppingCart->total, 2, ',', ' ') }} EUR</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
