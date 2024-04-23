@extends('layouts.app')
@section('content')
@include('layouts.mainpagetemplate')

<div id="app">
        <main class="py-4">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 offset-3 col-md-offset-6">
                        {{-- @if($message = Session::get('error'))
                            <div class="alert alert-danger alert-dismissible fade in" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <strong>Error!</strong> {{ $message }}
                            </div>
                        @endif
  
                        @if($message = Session::get('success'))
                            <div class="alert alert-success alert-dismissible fade {{ Session::has('success') ? 'show' : 'in' }}" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <strong>Success!</strong> {{ $message }}
                            </div>
                        @endif --}}
  
                        {{-- <div class="card card-default">
                            <div class="card-header">
                                Laravel - Razorpay Payment Gateway Integration
                            </div>
  
                            
                        </div> --}}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-white text-capitalize ps-3">  Payable Amount</h6>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="card-body text-center">
                                <form action="{{ route('razorpay.payment.store') }}" method="POST" >
                                    @csrf
                                    {{-- <input type="hidden" name="product_id" value="{{ $productId }}"> --}}
                                    {{-- <input type="hidden" name="quantity" value="{{ $quantity }}"> --}}
                                    <script src="https://checkout.razorpay.com/v1/checkout.js"
                                        data-key="{{ env('RAZORPAY_KEY') }}"
                                        data-amount="{{ request()->query('total') * 100 }}" 
                                        data-buttontext="Pay {{ request()->query('total') }} INR"
                                        data-name="CRUD Site.com"
                                        data-description="Rozerpay"   
                                        data-prefill.name="name"
                                        data-prefill.email="email"
                                        data-theme.color="#0000FF">
                                    </script>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
              <a href="{{ url('/mainpage') }}" class="btn btn-primary"><i class="fa fa-angle-left"></i> Continue Shopping</a>
        </main>
     
</div>
@endsection
