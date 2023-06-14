<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class StoreCoachRequest extends FormRequest
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
            'name_ar' => 'required',
            'name_en' => 'required',
            'email' => 'required|email|unique:players|unique:coachs|unique:users|unique:employes',
            'date_of_birth'    => 'required|date',
            'start_time'    => 'required|date',
            'end_time'      => 'required|date',
            'user_name'         => 'required|string',
            'phone'         => 'required|string',
            'password'         => 'required|string',
            'subscription_number'         => 'required|integer',
            'salary'         => 'required|string',
            'genders_id'         => 'required|integer',
            'nationality_id'         => 'required|integer',
            'location_id'         => 'required|integer',
            'sub_location_id'         => 'required|integer',
            'employment_type_id'         => 'required|integer',
            'profs_id'         => 'required|integer',
            'coach_description'         => 'required|string',
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
