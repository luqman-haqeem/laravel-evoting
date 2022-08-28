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
                    <div class="row">
                        <div class="col align-self-start">
                            <h6 class="m-0 font-weight-bold text-primary">Election</h6>
                        </div>
                        <div class="col align-self-end"><a href="{{ route('elections.create') }}" class="btn btn-success btn-sm float-right">Add Election</a></div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table Mydatatable">
                        <thead>
                            <th>Name</th>
                            <th>Start at</th>
                            <th>End at</th>
                            <th>Status</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @php
                                use Carbon\Carbon;
                            @endphp

                            @foreach ($elections as $election)
                                <tr>
                                    <td>{{ $election->name }}</td>
                                    <td>{{ $election->start_at }}</td>
                                    <td>{{ $election->end_at }}</td>
                                    <td>
                                        @php
                                            if (date('Y-m-d H:i:s') > $election->end_at) {
                                                echo "Ended";
                                            } else if( ( date('Y-m-d H:i:s')) > $election->start_at){
                                                echo "Started";
                                            }else{
                                                echo "Pending";
                                            }
                                        @endphp

                                    </td>
                                    <td>
                                        <div class="row">
                                            <a href="{{ route('elections.edit', $election->id) }}" class="text-info"><i
                                                    class="fas fa-cog"></i></a>
                                            &nbsp;&nbsp;
                                            <a href="{{ route('candidates.index', $election->id) }}" class="text-primary">
                                                <i class="fas fa-eye"></i></a>
                                            &nbsp;&nbsp;
                                            <a href="" class="text-success"><i class="fas fa-rocket"></i></a>
                                            &nbsp;&nbsp;
                                            <a href="" class="text-warning"><i class="fas fa-poll"></i></a>
                                            &nbsp;&nbsp;
                                            <form action="{{ route('elections.destroy', $election->id) }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn p-0">
                                                    <div class="text-danger"><i class="fas fa-trash"></div></i>
                                                </button>
                                            </form>
                                        </div>

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
