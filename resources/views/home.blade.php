@extends('layouts.starlight')

@section('title')
   Dashboard 
@endsection
@section('dashboard')
   active 
@endsection
@section('breadcrumb')
    <nav class="breadcrumb sl-breadcrumb">
       
        <span class="breadcrumb-item active">Dashboard</span>
      </nav>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                <div class="alert alert-success text-center">
            
                    Total users: {{ $users->count() }}
              </div>

             <table class="table table-bordered">

                        <thead>
                            <tr>
                                <th>Sl No</th>
                                <th>Name</th>
                                <th>Email Address</th>
                                <th>Account Creat At</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                               
                                <td>{{ $loop->index+1 }}</td>
                                <td>{{Str::title ($user->name)  }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->created_at->diffForHumans() }}</td>
                                
                                </tr>
                            @endforeach
                            
                        </tbody>
            </table>
             {{-- {{ $users->links() }} --}}

             </div>
        </div>
     </div>
    </div>
</div>
@endsection
