<?php

namespace Modules\Area\Http\Requests\Area;

use App\Http\Controllers\ValidationRequests;
use Illuminate\Validation\Rule;
use Modules\Area\Rules\AreaIsActive;

class UpdateZipCodeRequest extends ValidationRequests
{
    public function rules(): array
    {
        return [
            'zip_code_id' => 'required|integer|exists:zip_codes,id,deleted_at,NULL',
            'area_id'     => ['required', 'integer', 'exists:areas,id,deleted_at,NULL', new AreaIsActive()],
            'name'        => ['required', 'min:3', 'max:10', Rule::unique('zip_codes')->ignore(request('zip_code_id'))],
            'is_active'   => 'required|integer|in:0,1'
        ];
    }

    public function messages(): array
    {
        return [
            'zip_code_id.required' => "Zip Code Is Required",
            'zip_code_id.integer'  => "Zip Code Must Be Integer",
            'zip_code_id.exists'   => "Zip Code Is Not Exists",
            'area_id.required'     => "Area Id Is Requited",
            'area_id.integer'      => "Area Id Must be Integer",
            'area_id.exists'       => "Area Id Is Not Exist",
            'name.required'        => "Name Is Required",
            'name.min'             => "Name At Least Three Character To Search",
            'name.max'             => "Name Maximum Character Is 10 Char",
            'name.unique'          => "Name Must Be Unique",
            'is_active.required'   => "Is Active Is Required",
            'is_active.in'         => "Is Active Must Be 0 Or 1",

        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
