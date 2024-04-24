@extends('layouts.app')
   
@section('content')
@include('layouts.mainpagetemplate')


{{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script> --}}
   
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" /> --}}

    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12 col-12 main-section">
                <div class="d-flex justify-content-end"> <!-- Align items to the right -->
                    <a href="{{ route('cart') }}" class="btn btn-info">
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart 
                    </a>
                </div>
            </div>
        </div>
    </div>
    <br/>

@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<div class="row">
    @foreach($products as $product)
        <div class="col-sm-6 col-md-3">
            <div class="thumbnail"> 
                <img src="{{ asset('assets/images/' . $product->image) }}" alt="{{ $product->name }}" style="height : 170px; width : 245px">
                <div class="caption">                  
                    <h4>{{ $product->name }}</h4>
                    <p>{{ $product->detail }}</p>
                    <p><span><del>{{ number_format($product->price * 1.10) }}</del></span>
                       <b> <span> <i class="fas fa-rupee-sign"></i> {{ number_format($product->price) }} </span></b></p>
                    <p><strong>Quantity: </strong> {{ $product->quantity }}</p>
                    <p class="btn-holder"><a href="{{ route('add.to.cart', $product->id) }}" class="btn btn-primary btn-block text-center" role="button">Add to cart</a> </p>
                </div>
            </div>
        </div>
    @endforeach
</div>


<script>
    function redirectToCart() {
        window.location.href = "{{ route('cart') }}";
    }
</script>
@endsection