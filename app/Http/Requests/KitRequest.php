<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class KitRequest extends FormRequest
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
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'city_pickup_code'   => 'Выберете откуда',
            'city_delivery_code' => 'Выберите куда',
            'count_place.*'       => 'обязательно',
            'weight.*'            => 'обязательно',
            'height.*'            => 'обязательно',
            'width.*'             => 'обязательно',
            'length.*'            => 'обязательно',
            'declared_price'     => 'Введите стоимость',
        ];
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'city_pickup_code'     => [
                Rule::notIn(['0']),
            ],
            'city_delivery_code'   => [
                Rule::notIn(['0']),
            ],
            'count_place.*'        => 'required',
            'weight.*'             => 'required',
            'height.*'             => 'required',
            'width.*'              => 'required',
            'length.*'             => 'required',
            'declared_price'       => 'required',
            'insurance_agent_code' =>  [
                'sometimes',
                Rule::notIn(['0']),
            ],
        ];
    }
}
