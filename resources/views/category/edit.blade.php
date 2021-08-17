@extends('layouts.starlight')

@section('title')
      Edit Category - {{ $category_info ->category_name}} 
@endsection
@section('category')
   active 
@endsection
@section('breadcrumb')
    <nav class="breadcrumb sl-breadcrumb">
         <a class="breadcrumb-item" href="{{ route('home') }}">Dashboard</a>
         <a class="breadcrumb-item" href="{{ route('category') }}">Category</a>
        <span class="breadcrumb-item active"> Edit Category</span>
      </nav>
@endsection


@section('content')
    

<div class="container">
        <div class="row">
            
                
            <div class="col-6 m-auto" >
               

                 <div class="card ">
                    <div class="card-header">Edit Category

                    </div>
                        <div class="card-body">
                            <form action="{{ route('categoryeditpost') }}" method="POST">
                                @csrf
                                    <div class="form-group">
                                        <label>Category Name</label>
                                        <input type="hidden" name="category_id" value="{{$category_info ->id  }}">
                                        <input type="text" class="form-control" placeholder="Enter category name" name="category_name" value="{{ $category_info ->category_name }}">
                                        @if ($errors->all())
                                            @foreach($errors->all() as $error)
                                                <span class="text-danger">{{ $error }}</span>
                                               @endforeach 
                                        @endif
                                       
                                    </div>
                                   
                                    <button type="submit" class="btn btn-primary">Edit Category Now</button>
                                    @if (session('category_insert_status') )
                                        
                                   
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
