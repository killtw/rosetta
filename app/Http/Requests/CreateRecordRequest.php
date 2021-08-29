<?php

namespace App\Http\Requests;

use App\Rules\PhoneRule;
use App\Rules\RecordMerchantNumberRule;
use App\Rules\RecordTextRule;
use Illuminate\Foundation\Http\FormRequest;

class CreateRecordRequest extends FormRequest
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
            'time' => 'required',
            'from' => ['required', new PhoneRule],
            'text' => ['required', 'string', new RecordTextRule, new RecordMerchantNumberRule],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge(['text' => preg_replace('/\s+/', '', trim($this->get('text')))]);
    }

    protected function passedValidation()
    {
        $preg = '/\d{15}/';

        $this->merge(['from' => str_replace('(+886)', 0, str_replace('-', '', $this->get('from')))]);

        if (preg_match($preg, data_get($this->all(), 'text'), $matches)) {
            $this->merge(['merchant_id' => ltrim($matches[0], 0)]);
        }
    }
}
