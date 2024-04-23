@extends('layouts.app')


@section('content')
@include('layouts.template')

    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <h2 class="text-center flex-grow-1">Add New Category</h2>
                    <a class="btn btn-primary" href="{{ route('products.index') }}">Back</a>
                </div>
            </div>
        </div>

        <form action="{{ route('products.storeCategory') }}" method="POST"  enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="form-group">
                        <label for="name"><strong>Category Name:</strong></label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Name">

                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6 offset-md-3 text-center mt-3">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
    <script src="{{asset('assets/js/validation.js')}}"></script>

    
@endsection



