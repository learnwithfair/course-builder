@extends('layouts.app')
@section('breadcrumb', 'Courses Management')

@section('content')
    <div class="container my-4">
        <div class="card-header d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-black mb-0">Dashboard</h2>
            <a href="{{ route('courses.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus-circle"></i> Add New Course
            </a>
        </div>

        <div class="d-flex justify-content-center align-items-center vh-100">
            <h1>Welcome to the Dashboard</h1>
        </div>


    </div>
@endsection
