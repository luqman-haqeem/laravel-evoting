@extends('layouts.admin')

@section('main-content')

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">{{ __('Edit Election') }}</h1>

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
                <h6 class="m-0 font-weight-bold text-primary"> Add Election</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('elections.update',$data['election']->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <div class="form-group">
                        <label for="election_name">Election Name</label>
                        <input type="text" class="form-control" id="election_name" name="election_name" aria-describedby="election_name_help" value="{{ $data['election']->name }}" placeholder="Enter Election Name">
                        <!-- <small id="election_name_help" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                    </div>
                    <div class="form-group">
                        <label for="election_start_at">Start At</label>
                        <input type="datetime-local" class="form-control" id="election_start_at" name="election_start_at" value="{{date('Y-m-d\TH:i:s',strtotime($data['election']->start_at)) }}" placeholder="Start date">
                    </div>
                    <div class="form-group">
                        <label for="faculty">End At</label>
                        <input type="datetime-local" name="election_end_at" id="election_end_at" class="form-control" value="{{date('Y-m-d\TH:i:s',strtotime($data['election']->end_at)) }}" placeholder="End Date">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>


</div>
@endsection