<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SkuRequest extends FormRequest
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
          'price' => ['required','numeric'],
          'promotion_price' => ['numeric','nullable'],
          'quantity' => ['required','numeric'],
        ];
    }
    public function messages() {
      return [
        'price.required' => 'Vui lòng nhập giá!',
        'price.numeric' => 'Giá chỉ được là số!',
        'promotion_price.numeric' => 'Giá khuyến mãi chỉ được là số!',
        'quantity.required' => 'Vui lòng nhập số lượng!',
        'quantity.numeric' => 'Số lượng chỉ được là số!',
      ];
    }
}
