<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Recaptcha implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        try {
            $data = array('secret' => config('app.google_secret_key'),'response' => $value);
            $verify = curl_init();
            curl_setopt($verify, CURLOPT_URL,"https://www.google.com/recaptcha/api/siteverify");
            curl_setopt($verify, CURLOPT_POST, true);
            curl_setopt($verify, CURLOPT_POSTFIELDS,http_build_query($data));
            curl_setopt($verify, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($verify);
            if(!json_decode($response) -> success){
                $fail('ReCaptcha verification failed.');
            }
        }
        catch (\Exception $e) {
            $fail('ReCaptcha verification failed.');
        }
    }
}
