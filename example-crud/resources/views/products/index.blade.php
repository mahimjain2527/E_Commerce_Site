@extends('layouts.app')

@section( 'content' )
@include('layouts.template')

<!DOCTYPE html>
<html>
<head>
    <title>Product Page</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" rel="stylesheet">


    <link rel="stylesheet" href="{{ asset('assets/css/nucleo-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/nucleo-svg.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/material-dashboard.css.map') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/material-dashboard.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/material-dashboard.css') }}">

    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    

    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>  
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js" crossorigin="anonymous"></script>
    

 
</head>
<body>      
    @yield( 'template' )
    
    
    <div class="container">
        
        <a class="btn btn-success" href="{{ route('products.create') }}" id="createNewProduct"> Create New Product</a>
        <a class="btn btn-success" href="{{ route('products.createCategory') }}" id="createNewCategory"> Create New Category</a>


        @if(Auth::check() && Auth::user()->isAdmin() && $users)
            <div class="form-group">
                <label for="user_dropdown">Select User:</label>
                <select class="form-control" id="user_dropdown">
                    <option value="">Select User</option>
                    @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ $selectedUserId == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            
        @endif
        <div>
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                Filter
            </button>
            <button class="btn btn-danger delete-icon ">
                <i class="fas fa-trash"></i> Delete
            </button>
            
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1" style="width: 270px">
                @if($categories)
                    <div class="form-group">
                        <label for="category_dropdown">Select Category:</label>
                        <select class="form-control" id="category_dropdown">
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $selectedCategoryId == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                @endif
                <div class="form-group">
                    <label for="min_price">Min Price:</label>
                    <input type="number" class="form-control" id="min_price" placeholder="Enter Min Price">
                </div>
                <div class="form-group">
                    <label for="max_price">Max Price:</label>
                    <input type="number" class="form-control" id="max_price" placeholder="Enter Max Price">
                </div>
                <div class="form-group">
                    <button class="btn btn-primary" id="save_button">Save</button>
                    <button class="btn btn-danger" id="reset_button">Reset</button>
                </div>
            
            </ul>
        </div>
        
        

        <table class="table table-bordered data-table">
            <thead>
                <tr>
                    <th><input type="checkbox" name="select_all" id="select_all"></th>
                    <th>No</th>
                    <th>Name</th>
                    <th>Details</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>User Name</th>
                    <th>Category</th>
                    <th width="280px">Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</body>
      
<script type="text/javascript">

    $(document).ready(function() {
                    
        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                    ajax: {
                            url: "{{ route('products.index.post') }}",
                            method: "POST",
                            data: function (d) {
                                d.category_id = $('#category_dropdown').val();
                                d.user_id = $('#user_dropdown').val();
                                d.min_price = $('#min_price').val();
                                d.max_price = $('#max_price').val();
                            }
                        },
                    dom: 'Bfrtip', 
                    buttons: [
                        {
                            extend: 'excel',
                            text: 'Export to Excel'
                        },
                        
                    ],
                    columns: 
                    [
                        {data: 'checkbox', name: 'checkbox', orderable: false, searchable: false},
                        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                        {data: 'name', name: 'name'},
                        {data: 'detail', name: 'detail'},
                        {data: 'price', name: 'price'},
                        {
                            data: 'image',
                            name: 'image',
                                render: function(data, type, full, meta) {
                                    if (data) {
                                        return "<img src='" + "{{ asset('assets/images/') }}/" + data + "' height='50' />";
                                    } else {
                                        return ''; 
                                    }
                        }
                          
                        },     
                        {data: 'username', name: 'username'},
                        {data: 'category_name', name: 'category_name'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                    ]
                });

                $('#select_all').on('click', function(){
                    $('.data-table input[type="checkbox"]').prop('checked', this.checked);
                });

            
                // Delete product event handler
                $('body').on('click', '.deleteProduct', function () {
                    var product_id = $(this).data("id");
                    console.log(product_id);

                    var confirmation = confirm("Are You sure want to delete !");
                
                    if (confirmation) {
                            $.ajax({
                                type: "DELETE",
                                url: "{{ route('products.store') }}/"+product_id,
                                success: function (data) {
                                    table.draw(); 
                                },
                                error: function (data) {
                                    console.log('Error:', data);
                                }   
                            });
                        }
                });


                // For deleting  multiple products using checkboxes
                $('.delete-icon').on('click', function () {
                    var selectedProducts = [];
                    $('input[type="checkbox"].select-row:checked').each(function() {
                        selectedProducts.push($(this).val());
                    });

                    if (selectedProducts.length === 0) {
                        alert('Please select at least one item before clicking delete.');
                        return;
                    }

                    var confirmation = confirm("Are you sure you want to delete the selected items?");

                    if (confirmation) {
                        $.ajax({
                            type: "POST",
                            url: "{{ route('products.destroyAll') }}", 
                            data: {
                                selectedProducts: selectedProducts
                            },
                            success: function (data) {
                                table.draw(); 
                            },
                            error: function (data) {
                                console.log('Error:', data);
                            }
                        });
                    }
                });


                $('#save_button').click(function(e) {
                    e.preventDefault();
                    table.draw(); // This now uses the updated AJAX data function to pass filters
                });

                // Reset button click event
                $('#reset_button').click(function (e) {
                    e.preventDefault(); 
                    $('#category_dropdown').val('');
                    $('#min_price').val('');
                    $('#max_price').val('');
                    $.fn.dataTable.ext.search.pop();
                    table.draw();
                });


                // User dropdown change event handler
                $('#user_dropdown').change(function () {
                    table.draw();
                });

        });


    }); 


</script>
    
</html>
@endsection