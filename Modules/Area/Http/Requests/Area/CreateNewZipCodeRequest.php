<?php

namespace Modules\Area\Http\Requests\Area;

use App\Http\Controllers\ValidationRequests;
use Modules\Area\Rules\AreaIsActive;

class CreateNewZipCodeRequest extends ValidationRequests
{
    public function rules(): array
    {
        return [
            'area_id' => ['required', 'integer', 'exists:areas,id,deleted_at,NULL', new AreaIsActive()],
            'name'    => 'required|unique:zip_codes,name|min:3|max:10',
        ];
    }

    public function messages(): array
    {
        return [
            'area_id.required' => "Area Id Is Requited",
            'area_id.integer'  => "Area Id Must be Integer",
            'area_id.exists'   => "Area Id Is Not Exist",
            'name.required'    => "Name Is Required",
            'name.min'         => "Name At Least Three Character To Search",
            'name.max'         => "Name Maximum Character Is 10 Char",
            'name.unique'      => "Name Must Be Unique",
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
