<?php

namespace Modules\Area\Rules;

use Closure;
use Illuminate\Contracts\Validation\InvokableRule;
use Modules\Area\Models\State;

class StateIsActive implements InvokableRule
{
    public function __invoke($attribute, $value, $fail): void
    {
        $stateIsExistAndActive = State::find($value);
        if (!$stateIsExistAndActive->is_active) {
            $fail('State Is Not Active');
        }
    }
}
