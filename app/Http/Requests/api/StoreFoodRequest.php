<?php

namespace App\Http\Requests\api;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class StoreFoodRequest extends FormRequest
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
            'name_ar' => 'string',
            'name_en' => 'required|string',
            'foodsystem_id'         => 'required|integer',
            'number'         => 'required|integer',
            'start_time'         => 'required|date',
            'end_time'         => 'required|date',
            'description'         => 'required|string',
            'components_of_the_diet'         => 'string'
        ];
    }
    protected function failedValidation(Validator $validator)
    {
//        $response = new JsonResponse([
//            'data' => [],
//            'message' => 'Validation Error',
//            'errors' => $validator->messages()->all(),
//        ], ResponseAlias::HTTP_UNPROCESSABLE_ENTITY);

        throw new ValidationException($validator);
    }
}
