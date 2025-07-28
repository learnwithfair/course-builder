<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCourseRequest;
use App\Models\Category;
use App\Models\Course;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller {
    public function index() {
        $courses = Course::withCount( 'modules' )->get();
        return view( 'courses.index', compact( 'courses' ) );
    }

    public function destroy( Course $course ) {
        $course->delete();
        return response()->json( ['status' => 'success', 'message' => 'Course deleted successfully'] );
    }

    public function show( Course $course ) {
        $course->load( 'modules.contents' );
        if ( request()->ajax() ) {
            return view( 'courses.partials.details', compact( 'course' ) )->render();
        }
        return view( 'courses.show', compact( 'course' ) );
    }

    // public function show( Course $course ) {
    //     $course->load( 'modules.contents' );
    //     $courseResource = new CourseResource( $course );

    //     if ( request()->ajax() ) {
    //         return view( 'courses.partials.details', ['course' => $courseResource] )->render();
    //     }

    //     return view( 'courses.show', ['course' => $courseResource] );
    // }

    public function create() {

        $categories = Category::all();
        return view( 'courses.create', compact( 'categories' ) );
    }

    public function store( StoreCourseRequest $request ) {
        DB::beginTransaction();
        try {
            // Handle image upload
            $imagePath = null;
            if ( $request->hasFile( 'feature_image' ) ) {
                $folder = filePath( 'courses' ); // Use helper to get folder path
                $imagePath = uploadImage( $request->file( 'feature_image' ), $folder );
            }

            // Create course
            $course = Course::create( [
                'title'         => $request->title,
                'feature_video' => $request->feature_video,
                'level'         => $request->level,
                'category_id'   => $request->category_id,
                'price'         => $request->price,
                'summary'       => $request->summary,
                'feature_image' => $imagePath,
            ] );

            // Create modules & contents
            foreach ( $request->modules as $moduleData ) {
                $module = $course->modules()->create( ['title' => $moduleData['title']] );
                foreach ( $moduleData['contents'] as $contentData ) {
                    $module->contents()->create( [
                        'title'             => $contentData['title'],
                        'video_source_type' => $contentData['video_source_type'] ?? null,
                        'video_url'         => $contentData['video_url'] ?? null,
                        'video_length'      => $contentData['video_length'] ?? null,
                    ] );
                }
            }

            DB::commit();
            return response()->json( ['status' => 'success', 'message' => 'Course created successfully'] );
        } catch ( \Exception $e ) {
            DB::rollBack();
            return response()->json( ['status' => 'error', 'message' => 'Something went wrong', 'error' => $e->getMessage()] );
        }
    }

}