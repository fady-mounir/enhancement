<?php

namespace Modules\Area\Http\Requests\Area;

use App\Http\Controllers\ValidationRequests;
use Modules\Area\Rules\StateIsActive;

class GetAreasRequest extends ValidationRequests
{
    public function rules(): array
    {
        return [
            'state_id' => ['required','integer','exists:states,id,deleted_at,NULL',new StateIsActive()],
            'search'   => 'nullable|min:3|max:10',
        ];
    }

    public function messages(): array
    {
        return [
            'state_id.required' => "State Id is Required",
            'state_id.integer'  => "State Id Must be Integer",
            'state_id.exists'   => "State Id Is Not exists",
            'search.min'        => "At Least Three Character To Search",
            'search.max'        => "Maximum Character Is 10 Char"
        ];
    }

    public function authorize(): bool
    {
        return true;
    }


}
