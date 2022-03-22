@extends('layouts.admin')

@section('main-content')

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">{{ __('Voter') }}</h1>

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
                <h6 class="m-0 font-weight-bold text-primary">Voter</h6>
                <a href="{{ route('voters.create') }}" class="btn btn-success btn-sm">Add Voter</a>
            </div>
            <div class="card-body">
                <table class="table Mydatatable">
                    <thead>
                        <th>Name</th>
                        <th>Matric Number</th>
                        <th>Faculty</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @foreach($voters as $voter)
                        <tr>
                            <td>{{$voter->matric_number}}</td>
                            <td>{{$voter->name}}</td>
                            <td>{{$voter->faculty->name}}</td>
                            <td>
                                <a href="{{ route('voters.edit', $voter->id) }}" class="btn btn-info btn-sm">Update</a>
                                <form action="{{ route('voters.destroy', $voter->id) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>


    </div>


</div>
@endsection