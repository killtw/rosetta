<?php

namespace App\Http\Requests;

use App\Rules\IdentityRule;
use Illuminate\Foundation\Http\FormRequest;

class CreateMerchantRequest extends FormRequest
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
            'name' => 'required',
            'phone' => 'required',
            'identity' => ['required', new IdentityRule],
            'location' => 'required_without:address|array',
            'location.lat' => 'numeric',
            'location.lng' => 'numeric',
            'address' => 'string|required_without:location',
        ];
    }
}
