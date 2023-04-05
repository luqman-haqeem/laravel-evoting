@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Add Election') }}</h1>

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
        <div class="col-lg-10 mb-4">

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"> Edit Election</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('elections.store') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="election_name">Election Name</label>
                                    <input type="text" id="election_name" name="election_name"
                                        class="form-control {{ $errors->has('election_name') ? 'is-invalid' : '' }}"
                                        value="" placeholder="Enter Election Name">
                                    @error('election_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror

                                </div>
                            </div>

                            <div class="col-md-7 col-lg-6 pb-2">
                                <label for="date_range">Date Range</label>

                                <input type="text"
                                    class="form-control {{ $errors->has('date_range') ? 'is-invalid' : '' }}"
                                    name="date_range" id="date_range" value="" />
                                @error('date_range')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                        <hr>
                        <h5>Candidate Setting</h5>

                        <h6>Maximum candidate per person</h6>
                        <div class="row">

                            @foreach ($data['sections'] as $section)
                                <div class="col-md-3 col-lg-2 col-sm-12">
                                    <div class="form-group">
                                        <label for="{{ strtoupper($section->name) }}">{{ $section->name }}</label>
                                        <div class="input-group input-group-sm mb-3 " style=" width: 100px;">
                                            <div class="input-group-prepend">
                                                <button class="btn btn-outline-danger btn-number" data-type="minus"
                                                    type="button" id="btn_minus"
                                                    data-field="{{ strtoupper($section->name) }}"><i class="fa fa-minus"
                                                        aria-hidden="true"></i>
                                                </button>
                                            </div>
                                            <input type="text"
                                                class="form-control max_candidate {{ $errors->has(strtoupper($section->name)) ? 'is-invalid' : '' }}"
                                                id="{{ strtoupper($section->name) }}"
                                                name="{{ strtoupper($section->name) }}" value="1" min="1"
                                                max="100">
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-success btn-number" data-type="plus"
                                                    type="button" id="btn_add"
                                                    data-field="{{ strtoupper($section->name) }}"><i class="fa fa-plus"
                                                        aria-hidden="true"></i></button>
                                            </div>
                                            @error(strtoupper($section->name))
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        @push('scripts')
            <script>
                $(function() {

                    $('#date_range').daterangepicker({
                        timePicker: true,
                        minDate: moment().startOf('day'),

                        startDate: moment().startOf('hour'),
                        endDate: moment().startOf('hour').add(24, 'hour'),
                        locale: {
                            format: 'DD MMM YYYY hh:mm A'
                        }
                    });

                    $('.btn-number').click(function(e) {
                        e.preventDefault();

                        fieldName = $(this).attr('data-field');
                        btnType = $(this).attr('data-type');
                        var input = $("input[name='" + fieldName + "']");
                        var currentVal = parseInt(input.val());

                        if (!isNaN(currentVal)) {
                            if (btnType == 'minus') {

                                if (currentVal > input.attr('min')) {
                                    input.val(currentVal - 1).change();
                                }
                                if (parseInt(input.val()) == input.attr('min')) {
                                    $(this).attr('disabled', true);
                                }

                            } else if (btnType == 'plus') {

                                if (currentVal < input.attr('max')) {
                                    input.val(currentVal + 1).change();
                                }
                                if (parseInt(input.val()) == input.attr('max')) {
                                    $(this).attr('disabled', true);
                                }

                            }
                        } else {
                            console.log('no number');
                            input.val(0);
                        }

                    })

                });


                $('.max_candidate').change(function() {

                    minValue = parseInt($(this).attr('min'));
                    maxValue = parseInt($(this).attr('max'));
                    valueCurrent = parseInt($(this).val());

                    name = $(this).attr('name');
                    if (valueCurrent >= minValue) {
                        $(".btn-number[data-type='minus'][data-field='" + name + "']").removeAttr('disabled')
                    } else {
                        alert('Sorry,that quantity not allow');
                        $(this).val($(this).data('oldValue'));
                    }
                    if (valueCurrent <= maxValue) {
                        $(".btn-number[data-type='plus'][data-field='" + name + "']").removeAttr('disabled')
                    } else {
                        alert('Sorry,that quantity not allow');
                        $(this).val($(this).data('oldValue'));
                    }


                });
                $(".max_candidate").keydown(function(e) {
                    // Allow: backspace, delete, tab, escape, enter and .
                    if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
                        // Allow: Ctrl+A
                        (e.keyCode == 65 && e.ctrlKey === true) ||
                        // Allow: home, end, left, right
                        (e.keyCode >= 35 && e.keyCode <= 39)) {
                        // let it happen, don't do anything
                        return;
                    }
                    // Ensure that it is a number and stop the keypress
                    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                        e.preventDefault();
                    }
                });
            </script>
        @endpush
    </div>
@endsection
