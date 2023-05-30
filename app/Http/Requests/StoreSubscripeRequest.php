<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class StoreSubscripeRequest extends FormRequest
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
            'user_name'      => 'required|string',
            'phone'      => 'required|integer',
            'subscription_number'      => 'required',
            'coach_description'      => 'required',
            'date_of_birth'    => 'required|date',
            'start_time'    => 'required|date',
            'end_time'      => 'required|date',
            'link_website'         => 'required',
            'link_facebook'         => 'required',
            'link_twitter'         => 'required',
            'link_youtupe'         => 'required',
            'player_id'         => 'required|integer',
            'employment_type'         => 'required',
            'nationality_id'         => 'required|integer',
            'location_id'         => 'required|integer',

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
