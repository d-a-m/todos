<?php

namespace App\Http\Requests\Api;

use App\Http\Traits\ApiResponseTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class TodoEditRequest extends FormRequest
{
    use ApiResponseTrait;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'todo_id' => 'required|integer|exists:todos,id',
            'title' => 'required|min:5',
            'description' => 'required|min:10',
            'api_token' => 'required|string|size:60'
        ];
    }

    /**
     * @param Validator $validator
     * @return \Illuminate\Http\JsonResponse|void
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->respondBadRequest());
    }
}
