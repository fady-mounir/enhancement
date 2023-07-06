<?php

namespace Modules\Area\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AreaCodesResource extends JsonResource
{
    public function toArray($areasItems): array
    {
        $areas = [];

        foreach ($areasItems as $areasItem) {
            $areas [] = $this->areaItem($areasItem);
        }

        return $areas;
    }

    private function areaItem($areasItem):array
    {
        return [
            'id'   => $areasItem->id,
            'name' => $areasItem->name,
        ];
    }
}
