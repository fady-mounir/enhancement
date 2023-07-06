<?php

namespace Modules\Area\Http\Requests\Area;

use App\Http\Controllers\ValidationRequests;

class GetStatesRequest extends ValidationRequests
{
    public function rules(): array
    {
        return [
            'search' => 'nullable|min:3|max:10',
        ];
    }

    public function messages(): array
    {
        return [
            'search.min' => "At Least Three Character To Search",
            'search.max' => "Maximum Character Is 10 Char"
        ];
    }

    public function authorize(): bool
    {
        return true;
    }


}
