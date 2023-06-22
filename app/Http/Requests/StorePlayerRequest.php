<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class StorePlayerRequest extends FormRequest
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
            'user_name'         => 'required|string',
            "email" => "required|email|unique:clubs,email|unique:employes,email|unique:coachs,email|unique:players,email," . $this->id,
            'date_of_birth'    => 'required|date',
            'weight'    => 'required|integer',
            'height'      => 'required|integer',
            'phone'         => 'required|string|min:10',
            'total'         => 'required|string',
            'password'         => 'required|string',
            'subscription_number'         => 'required|integer',
            'postal_code'         => 'required|string|max:7',
            'salary_month'         => 'required|integer',
            'genders_id'         => 'required|integer',
            'nationality_id'         => 'required|integer',
            'location_id'         => 'required|integer',
            'sub_location_id'         => 'required|integer',
            'subtype_id'         => 'required|integer',
            'coachs_id'         => 'required|integer',
            'profs_id'         => 'required|integer',
            'player_description'         => 'required|string',
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
