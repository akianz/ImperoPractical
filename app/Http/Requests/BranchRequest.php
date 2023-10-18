<?php

namespace App\Http\Requests;

use App\Models\BranchImages;
use App\Models\BranchTiming;
use App\Models\BusinessBranch;
use Illuminate\Foundation\Http\FormRequest;

class BranchRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "business_id" => ['required'],
            "name" => ['required'],
            'images.*' => ['image','mimes:jpeg,png,jpg','max:2048'],
        ];
    }

    public function messages()
    {
        return [
            'business_id.required' => 'Please select business.',
        ];
    }

}
