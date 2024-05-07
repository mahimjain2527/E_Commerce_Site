@extends('layouts.app')

@section( 'content' )
@include('layouts.template')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" rel="stylesheet">
</head>
<body>
    <table id="orders-table" class="table table-bordered" >
        <thead style="background-color: #e4f1fe">
            <tr>
                <th>Sr.No</th>
                <th>Customer ID</th>
                <th>Product ID</th>
                <th>Name</th>
                <th>Quantity</th>
                <th>Created At</th>
                <th>Updated At</th>
                
            </tr>
        </thead>
    </table>
    
</body>
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>   --}}
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>     

<script>
    $(document).ready(function() {
        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
      
        
            $('#orders-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                                url: "{{ route('orders.list') }}",
                                method: "POST",
                },
                
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'customer_id', name: 'customer_id' },
                    { data: 'product_id', name: 'product_id' },
                    { data: 'name', name: 'name' },
                    { data: 'quantity', name: 'quantity'},
                    { data: 'created_at', name: 'created_at' },
                    { data: 'updated_at', name: 'updated_at' },
                ]
            });
        })
    });

    </script>
</html>
@endsection

