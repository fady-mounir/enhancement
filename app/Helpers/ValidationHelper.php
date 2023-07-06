<?php

namespace App\Helpers;

class ValidationHelper
{
    public function getValidationErrorsWithRequest($validator): bool|array
    {
        if ($validator->fails()) {
            return $this->getValidationErrorMsgInArray($validator);
        }

        return true;
    }

    public function getValidationErrorsFromArray($validator): bool|array
    {

        if (array_key_exists('errors', $validator)) {

            $errors = [];

            foreach ($validator['errors'] as $field => $msg) {
                $errors[] = [
                    "field"     => $field,
                    "errorCode" => "logic",
                    "errorMsg"  => $msg
                ];
            }

            return $errors;

        }

        return true;

    }


    public function getValidationErrorMsgInArray($validator): array
    {
        $messages = $validator->errors();
        $errors   = [];

        foreach ($messages->jsonSerialize() as $field => $msg) {
            $errors[] = [
                "field"     => $field,
                "errorCode" => "Validation",
                "errorMsg"  => $msg[0]
            ];
        }

        return $errors;
    }

}
