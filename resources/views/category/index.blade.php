@extends('layouts.starlight')
@section('title')
   Category 
@endsection
@section('category')
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
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-6"> Category List</div>
                            <div class="col-6 text-right">
                                @if ($categories->count() != 0)


                                    <button id="delete_all_btn" class="btn btn-danger">Delete All</button>
                                @endif
                            </div>

                        </div>

                    </div>
                    <div class="card-body">
                        @if (session('category_delete_status'))


                            <div class="alert alert-danger">
                                {{ session('category_delete_status') }}
                            </div>
                        @endif

                        <table class="table table-bordered">

                            <thead>
                                <tr>
                                    <th>Delete?</th>
                                    <th>SL No</th>
                                    <th>Category Name</th>
                                    <th>Created At</th>
                                     <th>Updated At</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>


                                <form action={{ route('categorycheckdelete') }} method="POST">
                                    @csrf
                                    @forelse($categories as $category )

                                        <tr>
                                            <td>
                                                <input type="checkbox" class="delete_checkbox" name="category_id[]" value=" {{ $category->id }}">
                                            </td>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $category->category_name }}</td>
                                            <td>{{ $category->created_at->format('d/m/Y h:i:s A') }}</td>
                                            <td>

                                                @if ($category->updated_at)
                                                    {{ $category->updated_at->diffForhumans() }}
                                                
                                                @else
                                                    --

                                                    
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <a href="{{ route('categoryedit',  $category->id ) }}"
                                                        type="button" class="btn btn-info">Edit</a>
                                                    <a href="{{ route('categorydelete',  $category->id )}}"
                                                        type="button" class="btn btn-danger">Delete</a>
                                                </div>



                                            </td>

                                        </tr>
                                    @empty
                                        <tr class="text-center text-danger">
                                            <td colspan="50">No Data To Show</td>
                                        </tr>
                                    @endforelse





                            </tbody>


                        </table>
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <button type="button" class="btn btn-sm btn-info" id="check_all_btn">Check All</button>
                            <button type="button" class="btn btn-sm btn-warning" id="uncheck_all_btn">Uncheck All</button>
                        </div>

                        <button type="submit" class="btn btn-sm btn-danger">Check Deletel</button>
                        </form>
                    </div>
                </div>
                <div class="mt-5 ">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-6">

                                Deleted Category List
                            </div>

                        </div>

                    </div>
                    <div class="card-body">


                        <table class="table table-bordered">

                            <thead>
                                <tr>
                                    <th>SL No</th>
                                    <th>Category Name</th>
                                    <th>Created At</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>




                                @forelse($deleted_categories as $deleted_category )

                                    <tr>

                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $deleted_category->category_name }}</td>
                                        <td>{{ $deleted_category->created_at->format('d/m/Y h:i:s A') }}</td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="{{ route('categoryrestore', $deleted_category->id) }}"
                                                    type="button" class="btn btn-success">Restore</a>
                                                <a href="{{ route('categoryforcedelete',  $deleted_category->id )}}"
                                                    type="button" class="btn btn-danger">Force Delete</a>
                                            </div>



                                        </td>

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
                    <div class="card-header">Add Category

                    </div>
                    <div class="card-body">
                        <form action="{{ route('categorypost') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>Category Name</label>
                                <input type="text" class="form-control" placeholder="Enter category name"
                                    name="category_name">
                                @error('category_name')
                                    <span class="text-danger">{{ $message }}</span>

                                @enderror

                            </div>

                            <button type="submit" class="btn btn-primary">Add Category Now</button>
                            @if (session('category_insert_status'))

                                <br>
                                <br>
                                <div class="alert alert-success">
                                    {{ session('category_insert_status') }}
                                </div>
                            @endif
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
