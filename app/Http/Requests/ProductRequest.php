<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            "name" => "required",
            "category_id" => "required",
            "brand_id" => "required",
            "type_id" => "required",
            "unit_id" => "required",
            "stock_alert" => "required",
            "sell_price" => "required",
            "purchase_price" => "required",

        ];
    }
    public function messages()
        {
            $messages = new ValidationMessages;
    
            return [
                'name.required' => $messages->require('Name'),
                'category_id.required' => $messages->require('Category'),
                'brand_id.required' => $messages->require('Brand'),
                'type_id.required' => $messages->require('Type'),
                'unit_id.required' => $messages->require('Unit'), 
                'stock_alert.required' => $messages->require('Stock Alert'),
                'sell_price.required' => $messages->require('sell_price'),
                'purchase_price.required' => $messages->require('purchase_price'),
            ];
        }
}
