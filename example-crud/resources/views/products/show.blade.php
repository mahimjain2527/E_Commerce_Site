@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mt-3">
            <div class="col-lg-12 margin-tb">
                <div class="d-flex justify-content-between align-items-center">
                    <h2 class="text-center flex-grow-1">Product Details</h2>
                    <a class="btn btn-primary" href="{{ route('products.index') }}">Back</a>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-6 offset-md-3">
                <div class="form-group">
                    <label for="name"><strong>Name:</strong></label>
                    {{ $product->name }}
                </div>
            </div>
        </div>

        <div class="row ">
            <div class="col-md-6 offset-md-3">
                <div class="form-group">
                    <label for="detail"><strong>Details:</strong></label>
                    {{ $product->detail }}
                </div>
            </div>
        </div>

        <div class="row ">
            <div class="col-md-6 offset-md-3">
                <div class="form-group">
                    <label for="image"><strong>Images:</strong></label>
                    <img src="/assets/images/{{ $product->image }}" width="500px" class="enlarge-image-trigger" data-product-id="{{ $product->id }}">
                </div>
            </div>
        </div>


    </div>

   
@endsection
