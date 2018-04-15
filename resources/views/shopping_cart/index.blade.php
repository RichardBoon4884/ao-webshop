@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Shopping cart</div>
                    <div class="card-body">
                        <div class="list-group">
                            @foreach ($shoppingCart as $product)
                                <div class="list-group-item list-group-item-action">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1"><a href="{{ route('productView', ['id' => $product->id, 'slug' => urlencode($product->name)]) }}">{{ $product->name }}</a></h5>
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
                                        {{ Form::close() }}
                                    </div>
                                    <div><a href="{{ route('shoppingCartUpdate', ['productId' => $product->id, 'amount' => 0]) }}">Remove from shopping cart</a></div>
                                </div>
                            @endforeach

                            {{--@if($shoppingCart->count() == 0)--}}
                                {{--There are no products in your shopping cart.--}}
                            {{--@endif--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
