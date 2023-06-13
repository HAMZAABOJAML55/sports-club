<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

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
            'name_en'          => 'required|string|max:255',
            'name_ar'          => 'required|string|max:255',
            'training_group_id'         => 'required|integer',
            'number'         => 'required|integer',
            'duration_of_training'         => 'required|string',
            'training_number'         => 'required|integer',
            'description'         => 'required|string',
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
