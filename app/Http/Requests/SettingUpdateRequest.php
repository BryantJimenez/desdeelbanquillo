<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class SettingUpdateRequest extends FormRequest
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
            'facebook' => 'nullable|string|min:2|max:191',
            'instagram' => 'nullable|string|min:2|max:191',
            'twitter' => 'nullable|string|min:2|max:191',
            'email_one' => 'nullable|string|email|max:191',
            'email_two' => 'nullable|string|email|max:191',
            'brands' => 'nullable|file|mimetypes:image/*',
            'pre_url' => 'required|'.Rule::in(['http://', 'https://']),
            'listen' => 'nullable|string|min:2|max:191',
        ];
    }
}
