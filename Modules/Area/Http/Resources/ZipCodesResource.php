<?php

namespace Modules\Area\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ZipCodesResource extends JsonResource
{
    public function toArray($zipCodesItems): array
    {
        $zipCodes = [];

        foreach ($zipCodesItems as $zipCodesItem) {
            $zipCodes [] = $this->zipCodeItem($zipCodesItem);
        }

        return $zipCodes;
    }

    private function zipCodeItem($zipCodesItem): array
    {
        return [
            'id'   => $zipCodesItem->id,
            'name' => $zipCodesItem->name,
        ];
    }
}
