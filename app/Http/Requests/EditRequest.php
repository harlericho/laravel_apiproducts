<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditRequest extends FormRequest
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
            //
            'code' => 'required|min:6|unique:products,code,' . $this->route('product')->id,
            'names' => 'required|max:150',
            'price' => 'required|numeric',
            'image' => 'nullable',
        ];
    }
}
