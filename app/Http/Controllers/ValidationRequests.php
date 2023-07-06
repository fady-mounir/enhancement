<?php

namespace App\Http\Controllers;

use App\Helpers\MessageHandleHelper;
use App\Helpers\ValidationHelper;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ValidationRequests extends FormRequest
{
    protected MessageHandleHelper $messageHandler;
    private ValidationHelper      $ValidationHelper;

    public function __construct()
    {
        parent::__construct();
        $this->messageHandler   = new MessageHandleHelper();
        $this->ValidationHelper = new ValidationHelper();
    }


    protected function failedValidation(Validator $validator)
    {
        $errorsMessages = $this->ValidationHelper->getValidationErrorMsgInArray($validator);
        throw new HttpResponseException($this->messageHandler->getJsonBadRequestErrorResponse("", $errorsMessages));
    }
}
