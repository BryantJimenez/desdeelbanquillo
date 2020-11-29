<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class BannerUpdateRequest extends FormRequest
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
            'featured' => 'required|'.Rule::in([1, 2, 3, 4]),
            'image' => 'nullable|file|mimetypes:image/*',
            'pre_url' => 'required|'.Rule::in(['http://', 'https://']),
            'url' => 'nullable|string|min:3|max:191',
            'target' => 'nullable|'.Rule::in([1, 2]),
            'state' => 'required|'.Rule::in([1, 0])
        ];
    }
}
