@extends('layouts.app')
@section('breadcrumb', 'Courses Management')

@section('content')
    <div class="container my-4">
        <div class="card-header d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-black mb-0">Courses</h2>
            <a href="{{ route('courses.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus-circle"></i> Add New Course
            </a>
        </div>
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Course Name</th>
                    <th>Level</th>
                    <th>Price</th>
                    <th>Modules</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($courses as $index => $course)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $course->title }}</td>
                        <td>{{ $course->level }}</td>
                        <td>${{ $course->price }}</td>
                        <td>{{ $course->modules_count }}</td>
                        <td>
                            <a href="{{ route('courses.show', $course->id) }}" class="btn btn-info btn-sm"><i
                                    class="bi bi-eye"></i></a>
                            <button class="btn btn-danger btn-sm delete-course" data-id="{{ $course->id }}"><i
                                    class="bi bi-trash"></i></button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {

            // Delete course
            $('.delete-course').click(function() {
                let id = $(this).data('id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "This will delete the course permanently!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Yes'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ url('dashboard/courses') }}/" + id,
                            type: 'DELETE',
                            data: {
                                _token: "{{ csrf_token() }}"
                            },
                            success: function(res) {
                                Toast.fire({
                                    icon: 'success',
                                    title: res.message ||
                                        'Course Deleted successfully!',
                                    timer: 3000
                                });
                                location.reload();
                            }
                        });
                    }
                });
            });
        });
    </script>
@endpush
