<?php

namespace Modules\Area\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use Modules\Area\Http\Requests\Area\CreateNewZipCodeRequest;
use Modules\Area\Http\Requests\Area\DeleteZipCodeRequest;
use Modules\Area\Http\Requests\Area\GetAreasRequest;
use Modules\Area\Http\Requests\Area\GetStatesRequest;
use Modules\Area\Http\Requests\Area\GetZipCodesRequest;
use Modules\Area\Http\Requests\Area\UpdateZipCodeRequest;
use Modules\Area\Services\IAreaServices;

class AreaController extends ApiController
{
    private IAreaServices $areaService;

    public function __construct(IAreaServices $areaService)
    {
        parent::__construct();
        $this->areaService = $areaService;
    }

    public function getStates(GetStatesRequest $request): object
    {
        $statesData = $this->areaService->getStates($request);
        return $this->messageHandler->getJsonSuccessResponse("", $statesData);
    }

    public function getAreas(GetAreasRequest $request): object
    {
        $areasData = $this->areaService->getAreaCode($request);
        return $this->messageHandler->getJsonSuccessResponse("", $areasData);
    }

    public function getZipCodes(GetZipCodesRequest $request): object
    {
        $zipCodes = $this->areaService->getZipCodes($request);
        return $this->messageHandler->getJsonSuccessResponse("", $zipCodes);
    }

    public function CreateNewZipCode(CreateNewZipCodeRequest $request): object
    {
        $this->areaService->createNewZipCode($request);
        return $this->messageHandler->getJsonSuccessResponse();
    }

    public function UpdateZipCode(UpdateZipCodeRequest $request): object
    {
        $this->areaService->updateZipCode($request);
        return $this->messageHandler->getJsonSuccessResponse();
    }

    public function DeleteZipCode(DeleteZipCodeRequest $request): object
    {
        $this->areaService->deleteZipCode($request);
        return $this->messageHandler->getJsonSuccessResponse();
    }
}
