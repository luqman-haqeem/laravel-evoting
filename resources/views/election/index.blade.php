@extends('layouts.admin')

@section('main-content')

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">{{ __('Election') }}</h1>

@if (session('success'))
<div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@if (session('status'))
<div class="alert alert-success border-left-success" role="alert">
    {{ session('status') }}
</div>
@endif

<div class="row">

    <!-- Content Column -->
    <div class="col-lg-12 mb-4">

        <!-- Project Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Election
                <a href="{{ route('elections.create') }}" class="btn btn-success btn-sm pull-right">Add Election</a>

                </h6>
            </div>
            <div class="card-body">
                <table class="table Mydatatable">
                    <thead>
                        <th>Name</th>
                        <th>Start at</th>
                        <th>End at</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @foreach($elections as $election)
                        <tr>
                            <td>{{ $election->name }}</td>
                            <td>{{ $election->start_at }}</td>
                            <td>{{ $election->end_at }}</td>
                            <td>
                                <a href="{{ route('elections.edit',$election->id) }}" class="text-info"><i class="fas fa-cog"></i></a>
                                <a href="{{ route('candidates.index',$election->id) }}" class="text-primary"> <i class="fas fa-eye"></i></a>
                                <a href="" class="text-success"><i class="fas fa-rocket"></i></a>
                                
                                {{-- <form  action="{{ route('elections.destroy', $election->id) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form> --}}
                                
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>`
        </div>


    </div>


</div>
@endsection