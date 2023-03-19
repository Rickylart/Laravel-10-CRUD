<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductsRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'productName' => 'required',
            'productColor' => 'required',
            'productCategory' => 'required',
            'productPrice' => 'required|numeric',
        ];
    }

    public function messages(){
        return[
            'productName.required' => 'Product field is required',
            'productCategory.required' => 'Category field is required',
            'productColor.required' => 'Color field is required',
            'productPrice.required' => 'Price field is required'
        ];
    }
}
