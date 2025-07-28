@extends('layouts.app')

@section('breadcrumb', 'Courses Management')

@section('content')
    <div class="container my-4">
        <form id="courseForm" enctype="multipart/form-data">
            @csrf
            <div class="row g-3 my-2">
                <div class="col-md-6">
                    <label class="form-label">Course Title</label>
                    <input type="text" name="title" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Feature Video</label>
                    <input type="text" name="feature_video" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Level</label>
                    <input type="text" name="level" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Category</label>
                    <select name="category_id" class="form-select">
                        <option value="" disabled> Choose...</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat['id'] }}">{{ $cat['name'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Course Price</label>
                    <input type="number" step="0.01" name="price" class="form-control">
                    <small class="text-muted">If 0, the course is free.</small>
                </div>
                {{-- <div class="col-12">
                    <label class="form-label">Course Summary</label>
                    <textarea name="summary" class="form-control" rows="4"></textarea>
                </div> --}}

                <div class="col-12">
                    <label class="form-label">Course Summary</label>
                    <textarea id="courseSummary" name="summary" class="form-control"></textarea>
                    <div class="invalid-feedback"></div>
                </div>

                <div class="col-12">
                    <label class="form-label">Feature Image</label>
                    <input type="file" name="feature_image" class="form-control">
                </div>




            </div>


            <h5>Modules</h5>
            <div id="modulesWrapper"></div>
            <button type="button" id="addModule" class="btn btn-success mt-2"> <i class="bi bi-plus-circle me-1"></i> Add
                Module</button>

            <hr>
            <div class="mt-6 d-flex gap-3" style="justify-content: flex-end">
                <button type="submit" class="btn btn-success">Save</button>
                <a href="{{ route('courses.create') }}" class="btn btn-danger">Cancel</a>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        const storeCourseUrl = "{{ route('courses.store') }}";
    </script>

    <script src="{{ asset('assets/js/course-form.js') }}"></script>
@endpush
