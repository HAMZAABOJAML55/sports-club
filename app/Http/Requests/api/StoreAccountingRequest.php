<?php

namespace App\Http\Requests\api;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class StoreAccountingRequest extends FormRequest
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
            'number'   => 'integer',
            'coach_id' =>'integer',
            'player_id' =>'integer',
            'subtype_id' => 'required|integer',
            'discounts' => 'string',
            'draws' => 'string',
            'Payment_trainee_id'=>'integer',
            'Payment_for_trainee'=>'string',
            'total_salary'=>'integer',
            'tax'=>'string'
        ];
    }

    /**
     * @throws ValidationException
     */
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
