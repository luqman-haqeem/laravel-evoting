@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Faculty') }}</h1>

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
                            <h6 class="m-0 font-weight-bold text-primary">Faculty</h6>
                        </div>
                        <div class="col align-self-end"><a href="" class="btn btn-success btn-sm float-right">Add
                                Faculty</a></div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table Mydatatable">
                        <thead>
                            <th>Short Name</th>
                            <th>Full Name</th>
                            <th>Max Vote</th>
                            <th>Action</th>
                        </thead>
                        <tbody>

                            @foreach ($facultys as $faculty)
                                <tr>
                                    <td>{{ $faculty->name }}</td>
                                    <td>{{ $faculty->fullname }}</td>
                                    <td></td>
                                    <td>
                                        <div class="row">
                                            <a href="" class="text-info"><i class="fas fa-edit"></i></a>
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
