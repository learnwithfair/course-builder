@extends('layouts.app')


@section('content')
    <div class="container text-center py-5">
        <h1 class="mb-3">Welcome to the Course Creations</h1>
        <p class="lead">This is your dashboard where you can manage your inventory and tasks.</p>
        <a href="{{ route('dashboard') }}" class="btn btn-primary">Go to Dashboard</a>
    </div>
@endsection
