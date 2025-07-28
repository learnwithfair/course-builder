<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCourseRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array {
        return [
            'title'                                  => 'required|string|max:255',
            'category_id'                            => 'required|exists:categories,id',
            'price'                                  => 'nullable|numeric|min:0',
            'feature_image'                          => 'nullable|image|max:2048',
            'modules'                                => 'required|array|min:1',
            'modules.*.title'                        => 'required|string|max:255',
            'modules.*.contents'                     => 'required|array|min:1',
            'modules.*.contents.*.title'             => 'required|string|max:255',
            'modules.*.contents.*.video_source_type' => 'nullable|string',
            'modules.*.contents.*.video_url'         => 'nullable|url',
            'modules.*.contents.*.video_length'      => 'nullable|string',
        ];
    }
}