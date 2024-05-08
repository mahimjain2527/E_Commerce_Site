@extends('layouts.app')

@section('content')
@include('layouts.mainpagetemplate')

<hr>
<h4>My Orders</h4>

<table id="cart" class="table table-hover table-condensed">
    <thead style="background-color: #e4f1fe;">
        <tr>
            <th style="width:50%" colspan="2" class="text-center">Product</th>
           
            <th style="width:20%"class="text-center">Price</th>
            <th style="width:10%" class="text-center">Quantity</th>
            <th style="width:20%" class="text-center">Total</th>
            <th style="width:20%" class="text-center">Puchased Time</th>
            {{-- <th style="width:10%"></th> --}}
        </tr>
    </thead>

    <tbody>
        
        @foreach($orders as $order)
            <tr>
                
                <td>
                    <img src="{{ asset('assets/images/' . $order->image) }}" alt="{{ $order->name }}" width="100">
                </td>
                <td>{{ $order->name }}</td>
                <td class="text-center"><i class="fas fa-rupee-sign"></i> {{ $order->price }}</td>
                <td class="text-center">{{ $order->quantity }}</td>
                <td class="text-center"><i class="fas fa-rupee-sign"></i> {{ $order->total_price }}</td>
                <td class="text-center">{{ $order->created_at }}</td>
            </tr>
        @endforeach
    </tbody>


    <tfoot>
        <tr>
            <td colspan="5" class="text-right">
                <a href="{{ url('/mainpage') }}" class="btn btn-primary"><i class="fa fa-angle-left"></i> Continue Shopping</a>
            </td>
        </tr>
    </tfoot>
</table>    

@endsection