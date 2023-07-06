<?php

namespace Modules\Area\Services\Implementation;

use Modules\Area\Http\Resources\AreaCodesResource;
use Modules\Area\Http\Resources\StatesResource;
use Modules\Area\Http\Resources\ZipCodesResource;
use Modules\Area\Models\Area;
use Modules\Area\Models\State;
use Modules\Area\Models\ZipCode;
use Modules\Area\Services\IAreaServices;
use Illuminate\Http\Request;

class AreaServices implements IAreaServices
{
    public function getStates(Request $request): array
    {
        $states = State::where('is_active', 1);

        //Add Search Cognition If It Exists
        if ($request->get('search')) {
            $states = $states->where('name', 'like', '%' . $request->get('search') . '%');
        }

        $states = $states->get();

        return (new StatesResource($request))->toArray($states);
    }

    public function getAreaCode(Request $request): array
    {
        $areas = Area::where('state_id', $request->get('state_id'));

        //Add Search Cognition If It Exists
        if ($request->get('search')) {
            $areas = $areas->where('name', 'like', '%' . $request->get('search') . '%');
        }

        $areas = $areas->get();

        return (new AreaCodesResource($request))->toArray($areas);
    }

    public function getZipCodes(Request $request): array
    {
        $zipCodes = ZipCode::where('area_id', $request->get('area_id'));

        //Add Search Cognition If It Exists
        if ($request->get('search')) {
            $zipCodes = $zipCodes->where('name', 'like', '%' . $request->get('search') . '%');
        }

        $zipCodes = $zipCodes->get();

        return (new ZipCodesResource($request))->toArray($zipCodes);
    }

    public function createNewZipCode(Request $request): void
    {
        ZipCode::create([
            'name'      => $request->get('name'),
            'area_id'   => $request->get('area_id'),
            'is_active' => 1
        ]);
    }

    public function updateZipCode(Request $request): void
    {
        ZipCode::find($request->get('zip_code_id'))->update([
            'name'      => $request->get('name'),
            'area_id'   => $request->get('area_id'),
            'is_active' => $request->get('is_active')
        ]);
    }

    public function deleteZipCode(Request $request): void
    {
        ZipCode::find($request->get('zip_code_id'))->delete();
    }
}
