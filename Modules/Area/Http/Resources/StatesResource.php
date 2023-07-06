<?php

namespace Modules\Area\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StatesResource extends JsonResource
{
    public function toArray($statesItems): array
    {
        $states = [];

        foreach ($statesItems as $statesItem) {
            $states [] = $this->stateItem($statesItem);
        }

        return $states;
    }

    private function stateItem($stateItem):array
    {
        return [
            'id'   => $stateItem->id,
            'name' => $stateItem->name,
            'code' => $stateItem->code
        ];
    }
}
