@extends('layouts.app')

@section('content')
@include('layouts.template')

    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb mt-3">
                <div class="d-flex justify-content-between align-items-center" style="margin: 5px;">
                    <h2 class="text-center flex-grow-1">Edit Product</h2>
                    <a class="btn btn-primary" href="{{ route('products.index') }}">Back</a>
                </div>
            </div>
            
        </div>

        <form action="{{ route('products.update', $product->id) }}" method="POST" id="form1">
            @csrf
            @method('PUT')

            <div class="row mt-3">
                <div class="col-md-6 offset-md-3">
                    <div class="form-group">
                        <label for="name"><strong>Name:</strong></label>
                        <input type="text" name="name" value="{{ $product->name }}" class="form-control" placeholder="Name">
                        
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="form-group">
                        <label for="detail"><strong>Detail:</strong></label>
                        <textarea class="form-control" style="height: 150px;" name="detail" placeholder="Detail">{{ $product->detail }}</textarea>
                        
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="form-group">
                        <label for="image"><strong>Image:</strong></label>
                        <input type="file" name="image" class="form-control" value="{{ $product->image }}" placeholder="image">
                        <img src="/assets/images/{{ $product->image }}?{{ time() }}" width="300px">

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="form-group">
                        <label for="price"><strong>Price:</strong></label>
                        <input type="number" name="price" class="form-control" value="{{ $product->price }}" placeholder="Price">
                       
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 offset-md-3 text-center mt-2">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>

    <script src="{{asset('assets/js/validation.js')}}"></script>

@endsection
