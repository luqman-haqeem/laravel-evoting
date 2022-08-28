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
                    <div class="row">
                        <div class="col align-self-start">
                            <h6 class="m-0 font-weight-bold text-primary">Voter</h6>
                        </div>
                        <div class="col align-self-end">
                            <a href="{{ route('voters.create', $data['election']->id) }}"
                                class="btn btn-success btn-sm float-right">Add Voter</a>
                        </div>
                    </div>


                </div>
                <div class="card-body">
                    <table class="table Mydatatable">
                        <thead>
                            <th>Matric Number</th>
                            <th>Name</th>
                            <th>Faculty</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach ($data['voters'] as $voter)
                                <tr>
                                    <td>{{ $voter->matric_number }}</td>
                                    <td>{{ $voter->name }}</td>
                                    <td>{{ $voter->faculty->name }}</td>
                                    <td>
                                        <div class="row">
                                            <a
                                                href="{{ route('voters.edit', ['election' => $data['election'], 'voter' => $voter->id]) }}">
                                                <div class="text-success"><i class="fas fa-edit"></i></div>
                                            </a>
                                            <form
                                                action="{{ route('voters.destroy', ['election' => $data['election'], 'voter' => $voter->id]) }}"
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
