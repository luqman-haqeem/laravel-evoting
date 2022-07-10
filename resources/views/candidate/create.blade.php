@extends('layouts.admin')

@section('main-content')

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Add Candidate') }}</h1>

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
                    <h6 class="m-0 font-weight-bold text-primary">Add Candidate</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('candidates.store', $data['election']) }}" method="POST" class="dropzone"
                        id="my-dropzone" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="matric_number">Matric Number</label>
                            <select name="matric_number" id="matric_number" class="form-control">
                                <option value="">Select Matric Number</option>
                                @foreach ($data['voters'] as $voter)
                                    <option value="{{ $voter->id }}">{{ $voter->matric_number }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="candidate_section">Section</label>
                            <select name="candidate_section" id="candidate_section" class="form-control">
                                <option value="1">General</option>
                                <option value="2">Faculty</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="candidate_motto">Motto</label>
                            <input type="text" name="candidate_motto" id="candidate_motto" class="form-control">
                            @error('candidate_motto')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="candidate_image">Candidate Image</label>
                            <input type="file" name="candidate_image" id="candidate_image" class="filepond"
                                accept="image/png, image/jpeg, image/gif">
                            @error('candidate_image')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>

                    </form>
                </div>
            </div>


        </div>
{{-- 
        @push('scripts')
            <script>
                // FilePond.registerPlugin(FilePondPluginImagePreview);

                // const inputElement = document.querySelector('input[id="candidate_image"]');
                // // create(inputElement, {
                // //     // Only accept images
                // //     acceptedFileTypes: ['image/*'],
                // // });
                // const pond = FilePond.create(inputElement);
                FilePond.setOptions({
                    server: {
                        url: '/upload',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    }
                });

                FilePond.registerPlugin(
                    FilePondPluginFileValidateType,
                    FilePondPluginImageExifOrientation,
                    FilePondPluginImagePreview,
                    FilePondPluginImageCrop,
                    FilePondPluginImageResize,
                    FilePondPluginImageTransform,
                    FilePondPluginImageEdit
                );

                // Select the file input and use 
                // create() to turn it into a pond
                FilePond.create(
                    document.querySelector('input[id="candidate_image"]'), {
                        labelIdle: `Drag & Drop your picture or <span class="filepond--label-action">Browse</span>`,
                        imagePreviewHeight: 170,
                        imageCropAspectRatio: '1:1',
                        imageResizeTargetWidth: 200,
                        imageResizeTargetHeight: 200,
                        stylePanelLayout: 'compact circle',
                        styleLoadIndicatorPosition: 'center bottom',
                        styleProgressIndicatorPosition: 'right bottom',
                        styleButtonRemoveItemPosition: 'left bottom',
                        styleButtonProcessItemPosition: 'right bottom',
                    }
                );
            </script>
        @endpush --}}

    </div>
@endsection
