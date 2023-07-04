<?php

namespace App\Http\Requests\api;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class StoreTraningRequest extends FormRequest
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
            'training_group_id'         => 'required|integer',#unike__??
            'number'         => 'integer',
            'duration_of_training'         => 'required|string',
            'training_number'         => 'integer',
            'description'         => 'string',
            'number_of_iterations'         => 'required|integer',

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
