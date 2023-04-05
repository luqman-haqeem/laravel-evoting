@extends('layouts.admin')

@section('main-content')
    <style>
        .custom-file-hidden {
            display: none;
        }

        .custom-file-upload {
            border: 1px solid #ccc;
            display: inline-block;
            padding: 6px 12px;
            cursor: pointer;
        }
    </style>
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
        <div class="col-lg-8 mb-4">

            <!-- Project Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Candidate Information</h6>
                </div>
                <div class="card-body">
                    <form
                        action="{{ route('candidates.update', ['election' => $data['election'], 'candidate' => $data['candidate']->id]) }}"
                        method="POST" enctype="multipart/form-data">
                        {{-- <form action="{{route('candidates.update',['election' => $data['election'], 'candidate' => $data['candidate']->id] )}}" method="POST" enctype="multipart/form-data"> --}}
                        @csrf
                        <input type="hidden" name="_method" value="PUT">


                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="matric_number">Matric Number</label>
                                    <input type="text" name="matric_number" id="matric_number"
                                        value="{{ $data['candidate']->detail->matric_number }}" class="form-control"
                                        readonly>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="candidate_section">Section</label>
                                    <select name="candidate_section" id="candidate_section" class="form-control">
                                        @foreach ($data['sections'] as $section)
                                            <option value="{{ $section->id }}"
                                                {{ $data['candidate']->section_id == $section->id ? 'selected' : '' }}>
                                                {{ $section->name }}
                                            </option>
                                        @endforeach

                                    </select>

                                </div>
                            </div>

                        </div>
                        <div class="form-group">
                            <label for="name">Candidate Name</label>
                            <input type="text" name="name" id="name"
                                value="{{ $data['candidate']->detail->name }}" class="form-control" readonly>
                        </div>

                        <div class="form-group">
                            <label for="candidate_motto">Motto</label>
                            <input type="text" name="candidate_motto" id="candidate_motto" class="form-control"
                                value="{{ $data['candidate']->motto }}">
                        </div>

                        {{-- <div class="form-group">
                            <label for="candidate_image">Candidate Image</label>
                            <input type="file" name="candidate_image" id="candidate_image" class="form-control-file">
                            @error('candidate_image')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div> --}}
                        <button type="submit" class="btn btn-primary">Update</button>

                    </form>
                </div>
            </div>


        </div>
        <div class="col-lg-4 mb-4">

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Candidate Image</h6>
                </div>
                <div class="card-profile-image mt-4">
                    {{-- <figure class="rounded-circle avatar avatar font-weight-bold" style="font-size: 60px; height: 180px; width: 180px;" >
                        
                    </figure> --}}
                    <img class="rounded-circle avatar avatar shadow-lg bg-white rounded"
                        style="font-size: 60px; height: 180px; width: 180px;"
                        src="{{ url('storage/candidate/' . $data['candidate']->candidate_image) }}"
                        alt="Candidate profile image">
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="text-center">
                                <form
                                    action="{{ route('candidates.update_image', ['election' => $data['election'], 'candidate' => $data['candidate']->id]) }}"
                                    id="update_image" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="_method" value="PUT">

                                    <label class="btn btn-primary btn-sm">
                                        <input id="candidate_image" name="candidate_image" class="custom-file-hidden"
                                            type="file" accept="image/*" />
                                        Change Candidate Image
                                    </label>
                                    @error('candidate_image')
                                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>


    </div>
@endsection

@push('scripts')
    <script>
        $('#candidate_image').change(function() {
            $('#update_image').submit();
        });
    </script>
@endpush
