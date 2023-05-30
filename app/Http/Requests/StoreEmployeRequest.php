<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class StoreEmployeRequest extends FormRequest
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
            'name'          => 'required|string|max:255',
            'email'      => 'required|email',
            'date_of_birth'    => 'required|date',
            'start_time'    => 'required|date',
            'end_time'      => 'required|date',
            'salary'         => 'required|string',
            'nationality_id'         => 'required|integer',
            'emp_descriptio'         => 'required',
            'full_descriptio'         => 'required',
            'employee_num'         => 'required|integer',
            'section_id'         => 'required|integer',

        ];
    }
    protected function failedValidation(Validator $validator)
    {
        $response = new JsonResponse([
            'data' => [],
            'message' => 'Validation Error',
            'errors' => $validator->messages()->all(),
        ], ResponseAlias::HTTP_UNPROCESSABLE_ENTITY);

        throw new ValidationException($validator, $response);
    }
}
