<?php

namespace App\Http\Requests;

use App\Rules\RecordMerchantNumberRule;
use Illuminate\Foundation\Http\FormRequest;

class SearchRecordRequest extends FormRequest
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
            'merchant' => ['required', new RecordMerchantNumberRule],
            'time' => 'required|date',
        ];
    }

    protected function passedValidation()
    {
        $preg = '/\d{15}/';

        if (preg_match($preg, data_get($this->all(), 'merchant'), $matches)) {
            $this->merge(['merchant_id' => ltrim($matches[0], 0)]);
        }
    }
}
