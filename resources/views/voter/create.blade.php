@extends('layouts.admin')

@section('main-content')

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">{{ __('Add Voter') }}</h1>

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
    <div class="col-lg-7 mb-4">

        <!-- Project Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"> Add Voter</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('voters.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="voter_name">Voter Name</label>
                        <input type="text" class="form-control" id="voter_name" name="voter_name" aria-describedby="voter_name_help" placeholder="Enter Voter Name">
                        <!-- <small id="voter_name_help" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                    </div>
                    <div class="form-group">
                        <label for="matric_number">Matric Number</label>
                        <input type="text" class="form-control" id="matric_number" name="matric_number" placeholder="Matric Number">
                    </div>
                    <div class="form-group">
                        <label for="faculty">Faculty</label>
                        <select name="faculty" id="faculty" class="form-control">
                            <option value="0" selected disabled>Select Faculty</option>
                            @foreach ($facultys as $faculty)
                            <option value="{{ $faculty->id }}" >{{$faculty->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <!-- Import Column -->
    <div class="col-lg-4 mb-4">

        <!-- Project Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"> Import Voter</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('voters.import') }}" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="file" class="form-control-file" name="import_voter" id="import_voter">
                        <small id="import_voter" class="form-text text-muted">only csv file are allowed</small>

                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection