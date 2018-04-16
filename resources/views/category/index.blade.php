@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Categories</div>
                <div class="card-body">
                    <div class="list-group">
                    @foreach ($categories as $category)
                        <a href="{{ route('categoryView', ['id' => $category->id, 'slug' => urlencode($category->title)]) }}" class="list-group-item">
                            <div>{{ $category->title }}</div>
                        </a>
                    @endforeach

                    @if($category->count() == 0)
                        There are no products found. Maybe create one?
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
