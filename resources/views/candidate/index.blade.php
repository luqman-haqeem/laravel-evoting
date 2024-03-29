@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Candidate') }}</h1>

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
                    <div class="row">
                        <div class="col align-self-start">
                            <h6 class="m-0 font-weight-bold text-primary">Candidate </h6>
                        </div>
                        <div class="col align-self-end"> 
                            <a href="{{ route('candidates.create', $data['election']) }}"
                                class="btn btn-success btn-sm float-right">Add Candidate</a></div>
                    </div>

                </div>
                <div class="card-body">
                    <table class="table Mydatatable">
                        <thead>
                            <th>Name</th>
                            <th>Matric Number</th>
                            <th>Faculty</th>
                            <th>Section</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach ($data['candidates'] as $candidate)
                                <tr>
                                    <td>{{ $candidate->detail->name }}</td>
                                    <td>{{ $candidate->detail->matric_number }}</td>
                                    <td>{{ $candidate->detail->faculty->name }}</td>
                                    <td>{{ $candidate->section->name }}</td>
                                    <td>
                                        <div class="row">
                                            <a href="{{ route('candidates.edit', ['election' => $data['election'], 'candidate' => $candidate->id]) }}"><i class="fas fa-edit text-success"></i>
                                            </a>
                                            <form
                                                action="{{ route('candidates.delete', ['election' => $data['election'], 'candidate' => $candidate->id]) }}"
                                                method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn pt-0">
                                                    <div class="text-danger"><i class="fas fa-trash"></div></i>
                                                </button>
                                            </form>
                                        </div>
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
