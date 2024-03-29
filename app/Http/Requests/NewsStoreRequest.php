<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class NewsStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string|min:2|max:191',
            'image' => 'required|file|mimetypes:image/*',
            'summary' => 'required|string|min:2|max:16770000',
            'content' => 'required|string|min:2|max:16770000',
            'video' => 'nullable|string|min:2|max:191',
            'tags' => 'required|string|min:1|max:2000',
            'comments' => 'required|'.Rule::in([0, 1]),
            'category_id' => 'required|array',
            'featured' => 'nullable',
            'state' => 'required|'.Rule::in([1, 2])
        ];
    }
}
