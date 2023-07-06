<?php

namespace Modules\Area\Http\Requests\Area;

use App\Http\Controllers\ValidationRequests;
use Modules\Area\Rules\AreaIsActive;

class GetZipCodesRequest extends ValidationRequests
{
    public function rules(): array
    {
        return [
            'area_id' => ['required', 'integer', 'exists:areas,id,deleted_at,NULL', new AreaIsActive()],
            'search'  => 'nullable|min:3|max:10',
        ];
    }

    public function messages(): array
    {
        return [
            'area_id.required' => "Area Id Is Requited",
            'area_id.integer'  => "Area Id Must be Integer",
            'area_id.exists'   => "Area Id Is Not Exist",
            'search.min'       => "At Least Three Character To Search",
            'search.max'       => "Maximum Character Is 10 Char"
        ];
    }

    public function authorize(): bool
    {
        return true;
    }


}
