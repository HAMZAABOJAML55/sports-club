<?php

namespace App\Http\Requests\api;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class StoreEmployeeRequest extends FormRequest
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
            "email" => "required|email|unique:coachs,email|unique:players,email|unique:clubs,email|unique:employes,email," . $this->id,
            "national_id" => "required|string|min:14|unique:employes,national_id,".$this->id,
            "emp_id" => "required|integer|unique:employes,emp_id,".$this->id,
            'description'    => 'string',
            'full_description'      => 'required|string',
            'section_id'         => 'required|integer',
            'emp_status'         => 'integer|max:1',
            'password'         => 'string',
            'date_of_birth'         => 'required|date',
            'image_path'=>'image|mimes:png,jpg,svg,gif|max:2048'

        ];
    }
    protected function failedValidation(Validator $validator)
    {
        $response = new JsonResponse([
            'data' => [],
            'message' => 'Validation Error',
            'errors' => $validator->messages()->all(),
        ], ResponseAlias::HTTP_UNPROCESSABLE_ENTITY);

        throw new ValidationException($validator);
    }

}
