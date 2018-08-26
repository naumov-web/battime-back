<?php

namespace App\Http\Requests;

use Illuminate\Http\JsonResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class Request extends FormRequest
{
    public $failedAuthorization = false;

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
     * Get the proper failed validation response for the request.
     *
     * @param  array  $errors
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function response(array $errors)
    {
        return new JsonResponse($errors, 422);
    }

    /**
     * Determine if the request has passed auth
     *
     * @return boolean
     */
    public function authStatus()
    {
        return !$this->failedAuthorization;
    }

    /**
     * Validate request.
     * 
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Illuminate\Validation\ValidationException
     */
    public function validate()
    {
        $this->prepareForValidation();

        $instance = $this->getValidatorInstance();

        if (! $this->passesAuthorization()) {
            $this->failedAuthorization();
        }
        if (! $instance->passes()) {
            $this->failedValidation($instance);
        }
    }
}