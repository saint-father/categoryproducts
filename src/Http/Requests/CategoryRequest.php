<?php

namespace Alexfed\Categoryproducts\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Request parameters validation rules customization
 */
class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // handle authorization logic for the request in "laravel/passport"
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name' => 'required|string|max:255',
        ];

        switch ($this->getMethod())
        {
            case 'POST':
                return $rules;
            case 'PUT':
                return [];
            case 'DELETE':
                return [
                    'id' => 'required|integer|exists:products'
                ];
            // case 'PATCH':
        }
    }

    /**
     * URL parameters availability
     *
     * @param array|mixed|null $keys
     * @return array
     */
    public function all($keys = null)
    {
        // return $this->all();
        $data = parent::all($keys);
        switch ($this->getMethod())
        {
            // case 'PUT':
            // case 'PATCH':
            case 'DELETE':
                $data['id'] = $this->route('id');
        }
        return $data;
    }
}
