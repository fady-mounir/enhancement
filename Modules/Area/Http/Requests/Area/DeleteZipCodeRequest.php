<?php

namespace Modules\Area\Http\Requests\Area;

use App\Http\Controllers\ValidationRequests;
use Modules\Area\Rules\AreaIsActive;

class DeleteZipCodeRequest extends ValidationRequests
{
    public function rules(): array
    {
        return [
            'zip_code_id' => 'required|integer|exists:zip_codes,id,deleted_at,NULL',
        ];
    }

    public function messages(): array
    {
        return [
            'zip_code_id.required' => "Zip Code Is Required",
            'zip_code_id.integer'  => "Zip Code Must Be Integer",
            'zip_code_id.exists'   => "Zip Code Is Not Exists",
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
