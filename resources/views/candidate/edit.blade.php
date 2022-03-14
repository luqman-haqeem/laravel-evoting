@extends('layouts.admin')

@section('main-content')

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">{{ __('Edit Candidate') }}</h1>

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
        `
        <!-- Project Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit Candidate</h6>
            </div>
            <div class="card-body">
                <form action="{{route('candidates.update',['election' => $data['election'], 'candidate' => $data['candidate']->id] )}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <div class="form-group">
                        <label for="matric_number">Matric Number</label>
                        <input type="text" name="matric_number" id="matric_number" value="{{$data['voter_id']->matric_number}}" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="candidate_section">Section</label>
                        <select name="candidate_section" id="candidate_section" class="form-control">
                            <option value="{{$data['candidate']->section}}" selected>{{$data['faculty']->name}}</option>
                            <option value="1">General</option>
                            <option value="2">Faculty</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="candidate_motto">Motto</label>
                        <input type="text" name="candidate_motto" id="candidate_motto" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="candidate_image">Image</label>
                        <input type="file" name="candidate_image" id="candidate_image" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>

                </form>
            </div>
        </div>


    </div>


</div>
@endsection

<!-- @section('javascript')
     <script type="text/javascript">
         
     </script>
@endsection -->