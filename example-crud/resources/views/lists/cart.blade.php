@extends('layouts.app')
  
@section('content')
@include('layouts.mainpagetemplate')


@if (session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('error') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
<table id="cart" class="table table-hover table-condensed">
    <thead>
        <tr>
            <th style="width:50%">Product</th>
            <th style="width:10%">Price</th>
            <th style="width:8%">Quantity</th>
            <th style="width:22%" class="text-center">Subtotal</th>
            <th style="width:10%"></th>
        </tr>
    </thead>
    <tbody>
        @php $total = 0 @endphp
        @forelse($cartItems as $item)
            @php $total += $item->price * $item->quantity @endphp
            <tr data-id="{{ $item->id }}">
                <td data-th="Product">
                    <div class="row">
                        <div class="col-sm-3 hidden-xs"><img src="{{ asset('assets/images/' . $item->product->image) }}" width="100" height="100" class="img-responsive"/></div>
                        <div class="col-sm-9">
                            <h4 class="nomargin">{{ $item->product->name }}</h4>
                        </div>
                    </div>
                </td>
                <td data-th="Price"><i class="fas fa-rupee-sign"></i> {{ $item->price }}</td>
                <td data-th="Quantity">
                    <input type="number" value="{{ $item->quantity }}" class="form-control quantity update-cart" />
                </td>
                <td data-th="Subtotal" class="text-center"><i class="fas fa-rupee-sign"></i> {{ $item->price * $item->quantity }}</td>
                <td class="actions" data-th="">
                    <button class="btn btn-danger btn-sm remove-from-cart" data-id="{{ $item->id }}">Delete</button>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5">Your cart is empty.</td>
            </tr>
        @endforelse
    </tbody>
    <tfoot>
        <tr>
            <td colspan="5" class="text-right"><h3><strong>Total <i class="fas fa-rupee-sign"></i> {{ $total }}</strong></h3></td>
        </tr>
        <tr>
            <td colspan="5" class="text-right">
                <a href="{{ url('/mainpage') }}" class="btn btn-primary"><i class="fa fa-angle-left"></i> Continue Shopping</a>
                <a href="{{ url('/razorpay-payment') }}?total={{ $total }}" class="btn btn-success" > CheckOut</a>
            </td>
            
        </tr>
    </tfoot>
</table>    

               
<script type="text/javascript">
  
    $(".update-cart").change(function (e) {
        e.preventDefault();
  
        var ele = $(this);
  
        $.ajax({
            url: '{{ route('update.cart') }}',
            method: "PATCH",
            data: {
                _token: '{{ csrf_token() }}', 
                id: ele.parents("tr").attr("data-id"), 
                quantity: ele.parents("tr").find(".quantity").val()
            },
            success: function (response) {
               window.location.reload();
            }                                                                           
        });                                   
    });
  
    $(".remove-from-cart").click(function (e) {
        e.preventDefault();
        

        var ele = $(this);
  
        if(confirm("Are you sure want to remove?")) {
            $.ajax({
                url: '{{ route('remove.from.cart') }}',
                method: "DELETE",
                data: {
                    _token: '{{ csrf_token() }}', 
                    id: ele.parents("tr").attr("data-id")
                },
                success: function (response) {
                    window.location.reload();
                }
            });
        }
    });
  
</script>

@endsection


