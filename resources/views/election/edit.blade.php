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

    {{-- @if ($errors->any())
        <div class="alert alert-danger border-left-danger alert-dismissible fade show" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif --}}


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
                    <h6 class="m-0 font-weight-bold text-primary"> Edit Election</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('elections.update', $data['election']->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="_method" value="PUT">
                        <div class="form-group">
                            <label for="election_name">Election Name</label>
                            <input type="text"  id="election_name" name="election_name" class="form-control {{ $errors->has('election_name') ? 'is-invalid' : '' }}"
                                 value="{{ $data['election']->name }}"
                                placeholder="Enter Election Name">
                            @error('election_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                        </div>
                        <div class="form-group">
                            <label for="election_start_at">Start At</label>
                            <input type="text" id="election_start_at" name="election_start_at"
                                class="form-control datetimepicker {{ $errors->has('election_start_at') ? 'is-invalid' : '' }}"
                                value="{{ date('d-m-Y H:i', strtotime($data['election']->start_at)) }}"
                                placeholder="Start date">
                            @error('election_start_at')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="faculty">End At</label>
                            <input type="text" name="election_end_at" id="election_end_at"
                                class="form-control datetimepicker {{ $errors->has('election_end_at') ? 'is-invalid' : '' }} "
                                value="{{ date('d-m-Y H:i', strtotime($data['election']->end_at)) }}"
                                placeholder="End Date">
                            @error('election_end_at')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        @push('scripts')
            <script>
                var config = {
                    enableTime: true,
                    dateFormat: "d-m-Y H:i",
                    // minDate: "today",
                };

                $('.datetimepicker').flatpickr(config);
            </script>
        @endpush

    </div>
@endsection
