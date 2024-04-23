@extends('layouts.app')


@section('content')

    @include('layouts.template')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <h2 class="text-center flex-grow-1">Add New Product</h2>
                    <a class="btn btn-primary" href="{{ route('products.index') }}">Back</a>
                </div>
            </div>
        </div>

        <form action="{{ route('products.store') }}" method="POST"  enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="form-group">
                        <label for="name"><strong>Name:</strong></label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Name">

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="form-group">
                        <label for="category"><strong>Category:</strong></label>
                        <select name="category_id" class="form-control">
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="form-group">
                        <label for="detail"><strong>Detail:</strong></label>
                        <textarea class="form-control" style="height: 100px;" name="detail" placeholder="Detail">{{ old('detail') }}</textarea>
                       
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="form-group">
                        <label for="image"><strong>Image:</strong></label>
                        <input type="file" name="image" class="form-control"  placeholder="image">
                       
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="form-group">
                        <label for="price"><strong>Price:</strong></label>
                        <input type="number" name="price" class="form-control" value="{{ old('price') }}" placeholder="Price">
                       
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="form-group">
                        <label for="quantity"><strong>Quantity:</strong></label>
                        <input type="number" name="quantity" class="form-control" value="{{ old('quantity') }}" placeholder="Quantity">
                       
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



