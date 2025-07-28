@extends('layouts.app')
@section('breadcrumb', 'Course Details')
@push('styles')
    <style>
        .img-thumbnail {
            height: 150px;
            width: 150px;
            object-fit: cover
        }
    </style>
@endpush
@section('content')
    <div class="container my-4">
        <h2>{{ $course->title }}</h2>
        <p class="text-muted">Level: {{ $course->level }} | Category: {{ $course->category_id }} | Price:
            ${{ $course->price }}</p>
        @if ($course->feature_image)
            <img src="/assets/images/courses/{{ $course->feature_image }}" class="img-fluid mb-3 img-thumbnail"
                alt="Course Image">
        @endif


        <div class="mb-4">
            <h5>Course Summary</h5>
            <div>{!! $course->summary !!}</div>
        </div>

        <div class="accordion" id="courseModules">
            @foreach ($course->modules as $mIndex => $module)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading{{ $mIndex }}">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapse{{ $mIndex }}">
                            Module {{ $mIndex + 1 }}: {{ $module->title }}
                        </button>
                    </h2>
                    <div id="collapse{{ $mIndex }}" class="accordion-collapse collapse"
                        data-bs-parent="#courseModules">
                        <div class="accordion-body">
                            @if ($module->contents->isEmpty())
                                <p class="text-muted">No contents added.</p>
                            @else
                                <div class="accordion" id="moduleContents{{ $mIndex }}">
                                    @foreach ($module->contents as $cIndex => $content)
                                        <div class="accordion-item">
                                            <h2 class="accordion-header"
                                                id="contentHeading{{ $mIndex }}_{{ $cIndex }}">
                                                <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#contentCollapse{{ $mIndex }}_{{ $cIndex }}">
                                                    Content {{ $cIndex + 1 }}: {{ $content->title }}
                                                </button>
                                            </h2>
                                            <div id="contentCollapse{{ $mIndex }}_{{ $cIndex }}"
                                                class="accordion-collapse collapse"
                                                data-bs-parent="#moduleContents{{ $mIndex }}">
                                                <div class="accordion-body">
                                                    @if ($content->video_url)
                                                        <p><strong>Video Source:</strong>
                                                            {{ ucfirst($content->video_source_type) }}</p>
                                                        <p><strong>URL:</strong> <a href="{{ $content->video_url }}"
                                                                target="_blank">{{ $content->video_url }}</a></p>
                                                    @endif
                                                    @if ($content->video_length)
                                                        <p><strong>Length:</strong> {{ $content->video_length }}</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
