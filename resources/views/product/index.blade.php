@extends('layouts.starlight')
@section('title')
   Category 
@endsection
@section('product')
   active 
@endsection
@section('breadcrumb')
    <nav class="breadcrumb sl-breadcrumb">
         <a class="breadcrumb-item" href="{{ route('home') }}">Dashboard</a>
        <span class="breadcrumb-item active">Category</span>
      </nav>
@endsection
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-8">
                <div class="card ">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-6">

                                Product List
                            </div>

                        </div>

                    </div>
                    <div class="card-body">


                        <table class="table table-bordered">

                            <thead>
                                <tr>
                                    <th>SL No</th>
                                    <th>Category Name </th>
                                    <th>Product Name</th>
                                    <th>Product Price</th>
                                    <th>Product Quantity</th>
                                    <th>Product Alert Quantity</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>



 
                                @forelse($products as $product )

                                    <tr>
                                        
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{App\Models\Category::find($product->category_id )->category_name }}</td>
                                        <td>{{ $product->product_name }}</td>
                                        <td>{{ $product->product_price }}</td>
                                        <td>{{ $product->product_quantity }}</td>
                                        <td>{{ $product->product_alert_quantity }}</td>
                                        <td>Edit & Delete</td>

                                    </tr>
                                @empty
                                    <tr class="text-center text-danger">
                                        <td colspan="50">No Data To Show</td>
                                    </tr>
                                @endforelse 





                            </tbody>


                        </table>



                    </div>

                </div>

            </div>
            <div class="col-4">

                <div class="card ">
                    <div class="card-header">Add Product

                    </div>
                    <div class="card-body">
                        <form action="{{ route('productpost') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>Category Name</label>
                               <select class="form-control" name="category_id" >
                                   <option value="">-Choose One-</option>
                                   @foreach ($categories as $category)
                                <option value="{{$category->id}}">{{$category->category_name}}</option>
                                    
                                
                                   
                                    @endforeach
                               </select>
                               

                            </div>
                            <div class="form-group">
                                <label>Product Name</label>
                                <input type="text" class="form-control" 
                                    name="product_name">
                               

                            </div>
                            <div class="form-group">
                                <label>Product Price</label>
                                <input type="text" class="form-control" 
                                    name="product_price">
                               

                            </div>
                            <div class="form-group">
                                <label>Product Quantity</label>
                                <input type="text" class="form-control" 
                                    name="product_quantity">
                               

                            </div>
                            <div class="form-group">
                                <label>Product Short Description</label>
                               
                                     <textarea class="form-control" rows="4" name="product_short_description" ></textarea>
                               

                            </div>
                            <div class="form-group">
                                <label>Product Long Description</label>
                               
                                    <textarea class="form-control" rows="4" name="product_long_description" ></textarea>
                               

                            </div>
                            <div class="form-group">
                                <label>Alert Quantity </label>
                                <input type="text" class="form-control" 
                                    name="product_alert_quantity">
                               

                            </div>

                            <button type="submit" class="btn btn-primary">Add Product Now</button>
                           
                        </form>

                    </div>

                </div>

            </div>
        </div>



    </div>

@endsection
@section('footer_scripts')
    <script>
        $(document).ready(function() {
            $('#delete_all_btn').click(function() {
                Swal.fire({
                    title: 'Are you sure?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "category/all/delete";
                    }
                })
            });
            $('#check_all_btn').click(function() {
                $('.delete_checkbox').attr('checked', 'checked');
                $('#uncheck_all_btn').removeAttr('checked');
            });
            $('#uncheck_all_btn').click(function() {
                $('.delete_checkbox').removeAttr('checked');

            });
        });

    </script>

@endsection
