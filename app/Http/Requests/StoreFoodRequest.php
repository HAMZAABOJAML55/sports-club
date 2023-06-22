<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

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
            'name_en'          => 'required|string|max:255',
            'name_ar'          => 'required|string|max:255',
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
