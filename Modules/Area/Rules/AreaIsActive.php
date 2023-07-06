<?php

namespace Modules\Area\Rules;

use Illuminate\Contracts\Validation\InvokableRule;
use Modules\Area\Models\Area;

class AreaIsActive implements InvokableRule
{
    public function __invoke($attribute, $value, $fail): void
    {
        $areaIsExistAndActive = Area::find($value);
        if (!is_null($areaIsExistAndActive) && !$areaIsExistAndActive->is_active) {
            $fail('Area Is Not Active');
        }
    }
}
