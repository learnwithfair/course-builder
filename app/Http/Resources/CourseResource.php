<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource {
    public function toArray( $request ) {
        return [
            'id'            => $this->id,
            'title'         => $this->title,
            'level'         => $this->level,
            'price'         => number_format( $this->price, 2 ),
            'feature_image' => $this->feature_image ? '/assets/images/courses/' . $this->feature_image : null,
            'summary'       => $this->summary,
            'modules'       => $this->modules->map( function ( $module ) {
                return [
                    'id'       => $module->id,
                    'title'    => $module->title,
                    'contents' => $module->contents->map( function ( $content ) {
                        return [
                            'id'                => $content->id,
                            'title'             => $content->title,
                            'video_source_type' => $content->video_source_type,
                            'video_url'         => $content->video_url,
                            'video_length'      => $content->video_length,
                        ];
                    } ),
                ];
            } ),
        ];
    }
}