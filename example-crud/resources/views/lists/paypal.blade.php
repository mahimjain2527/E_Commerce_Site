@extends('layouts.app')
@section( 'content' )
<div class="container">
    <div class="row mt-5 mb-5">
        <div class="col-10 offset-1 mt-5">
            <div class="card">
                <div class="card-header bg-primary">
                    <h3 class="text-white">PayPal Payment Gateway Integration </h3>
                </div>
                <div class="card-body">
  
                    @if ($message = Session::get('success'))
                      <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ $message }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                    @endif
  
                    @if ($message = Session::get('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                          <strong>{{ $message }}</strong>
                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                          
                    <center>
                        <a href="{{ route('paypal.payment', ['total' => $total]) }}" class="btn btn-success"> CheckOut</a>

                    </center>
  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


{{-- <h1>hello</h1> --}}