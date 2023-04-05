@extends('layouts.app')

@push('style')
    <style>
        .card[data-clickable=true] {
            cursor: pointer;
        }

        .card[data-clickable=true]:hover {
            background-color: #ecefff;
            border-color: #4e73df;
            box-shadow: 0 0 11px rgba(33, 33, 33, .5);
        }
    </style>
@endpush

@section('content')
    <div class="container">
        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">{{ __('General Candidate') }}</h1>

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
                <div class="card shadow mb-4 ">
                    <div class="card-header py-3">
                        <!-- Nav tabs -->
                        <ul class="nav nav-pills  nav-justified">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="pill" href="#step1">Step 1</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#step2">Step 2</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#step3">Step 3</a>
                            </li>
                        </ul>

                    </div>
                    <div class="card-body">
                        <form>
                            <!-- Tab panes -->
                            <div class="tab-content ">
                                <div id="step1" class="container tab-pane active "><br>
                                    <p>step 1</p>

                                    <div class="card-columns">
                                        @foreach ($candidates['general'] as $candidate)
                                            <div class="card " data-clickable="true">
                                                <img class="card-img-top"
                                                    src="{{ url('storage/candidate/' . $candidate->candidate_image) }}"
                                                    alt="candidate image" height="200" width="200">
                                                <div class="card-body">
                                                    <h5 class="card-title">{{ $candidate->detail->name }}</h5>
                                                    <p class="card-text"> {{ $candidate->motto }}</p>

                                                    {{-- <a href="#" class="btn btn-outline-primary ">Select</a> --}}

                                                    <div class="btn-group-toggle" data-toggle="buttons">
                                                        <label class="btn btn-outline-success btn_select ">
                                                            <input type="checkbox" value="{{ $candidate->id }}">Select
                                                        </label>
                                                    </div>


                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <div class="pt-4">
                                        <button class="btn btn-primary next-btn" type="button">Next</button>
                                    </div>
                                </div>
                                {{-- end step 1 --}}
                                <div id="step2" class="container tab-pane "><br>
                                    <p>step 2</p>
                                    <div class="card-columns">
                                        @foreach ($candidates['faculty'] as $candidate)
                                            <div class="card " data-clickable="true">
                                                <img class="card-img-top"
                                                    src="{{ url('storage/candidate/' . $candidate->candidate_image) }}"
                                                    alt="candidate image" height="200" width="200">
                                                <div class="card-body">
                                                    <h5 class="card-title">{{ $candidate->detail->name }}</h5>
                                                    <p class="card-text"> {{ $candidate->motto }}</p>

                                                    <div class="btn-group-toggle" data-toggle="buttons">
                                                        <label class="btn btn-outline-success btn_select ">
                                                            <input type="checkbox" value="{{ $candidate->id }}">Select
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <div class="pt-4">
                                        <button class="btn btn-secondary back-btn" type="button">Back</button>
                                        <button class="btn btn-primary next-btn" type="button">Next</button>
                                    </div>

                                </div>
                                {{-- end step 2 --}}

                                <div id="step3" class="container tab-pane "><br>
                                    <p>step 3</p>
                                    <div class="card-columns" id="summary_section">

                                    </div>
                                    <div class="pt-4">
                                        <button class="btn btn-secondary back-btn" type="button">Back</button>

                                        <button class="btn btn-primary next-btn" type="button">Next</button>
                                    </div>

                                </div>
                                {{-- end step 3 --}}

                            </div>
                        </form>


                    </div>
                </div>


            </div>




        </div>
        @push('scripts')
            <script>
                $(document).ready(() => {
                    // $('.card[data-clickable=true]').on('click', (e) => {
                    $(".card[data-clickable=true]").click(function() {
                        // var href = $(e.currentTarget).data('href');
                        // window.location = href;
                        // test(this)
                        if (!$(event.target).is($(this).children().find('label'))) {
                            changeCardState(this);
                            changeButtonState($(this).children().find('label'));

                        } else {
                            changeCardState(this)
                        }
                    });

                    function changeButtonState(obj) {
                        if ($(obj).hasClass('active')) {
                            $(obj).removeClass('active');
                        } else {
                            $(obj).addClass('active');
                        }
                    }

                    function changeCardState(obj) {

                        if ($(obj).hasClass('text-white bg-primary border-primary')) {
                            $(obj).removeClass('text-white bg-primary border-primary')
                            canAddToSummaryPage(false, obj)
                            assignId(false, $(obj).children().find('input'))
                        } else {
                            $(obj).addClass('text-white bg-primary border-primary')
                            canAddToSummaryPage(true, obj)

                            assignId(true, $(obj).children().find('input'))
                        }
                    }

                    $('.nav-pills a').click(function(e) {
                        e.preventDefault()

                        // Hide all of the panes
                        $('.tab-pane').hide()

                        // Show the pane corresponding to the clicked tab
                        $($(this).attr('href')).show()
                    })

                    $('.next-btn').click(function() {

                        let tabContent = $(this).parent().parent()
                        // Hide the current pane
                        tabContent.hide()

                        // console.log('Current pane:', tabContent)

                        // Show the next pane
                        var nextPane = tabContent.next()
                        // console.log('Next pane:', nextPane)

                        let tabHeader = $(`a[href='#${nextPane.attr('id')}']`)
                        tabHeader.click()

                        // tabHeader.addClass('active')
                        nextPane.show()
                    })


                    $('.back-btn').click(function() {
                        // Hide the current pane
                        let tabContent = $(this).parent().parent()

                        tabContent.hide()

                        let prevPane = tabContent.prev()
                        let tabHeader = $(`a[href='#${prevPane.attr('id')}']`)
                        tabHeader.click()

                        // Show the previous pane
                        tabContent.prev().show()
                    })

                    // store all checked checkbox
                    var checked = []

                    function assignId(canAssignId, input) {

                        (canAssignId) ? checked.push($(input).val()): checked = checked.filter(item => item !== $(input)
                            .val())

                        console.log(checked)
                    }
                    let elementchecked = []

                    function canAddToSummaryPage(canAdd, obj) {
                        var button = $(obj).clone();

                        if (canAdd) {

                            elementchecked.push(button)

                        } else {
                            console.log('here');
                      
                            for (var i = 0; i < elementchecked.length; i++) {
                                console.log('in',elementchecked[i]);
                                console.log('cloone',button);

                                if (elementchecked[i] == button) {
                                    console.log('got in array');
                                    // arr.splice(i, 1);
                                }

                            }

                        }
                        $('#summary_section').html(elementchecked)
                        console.log('elementchecked', elementchecked)


                    }

                });
            </script>
        @endpush
    </div>
@endsection
