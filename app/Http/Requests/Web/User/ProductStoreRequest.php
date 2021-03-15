<?php

namespace App\Http\Requests\Web\User;

use App\Http\Requests\Web\BaseRequest;

class ProductStoreRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {        
        return [
            'productname' => 'required|min:3',
            'description' => 'required|min:6',
            'image' => 'required',
            'quantity' => 'required|numeric',
            'discount' => 'nullable|numeric',
            'price' => 'required|numeric'
        ];
    }
    public function messages()
    {
        return [
            'productname.required' => 'Product Name is required',
            'productname.min' => 'Invalid Product Name',
            'description.required' => 'Description is required',
            'description.min' => 'Invalid Description',
            'image.required' => 'Image is required',
            'quantity.required' => 'Quantity is required',
            'quantity.numeric' => 'Quantity should be numeric',
            'dsicount.numeric' => 'Discount should be numeric',
            'price.required' => 'Price is required',
            'price.numeric' => 'Invalid Price provided'
        ];
    }
}
