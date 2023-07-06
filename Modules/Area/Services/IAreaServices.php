<?php

namespace Modules\Area\Services;

use Illuminate\Http\Request;

interface IAreaServices
{
    public function getStates(Request $request): array;
    public function getAreaCode(Request $request): array;
    public function getZipCodes(Request $request): array;
    public function createNewZipCode(Request $request): void;
    public function updateZipCode(Request $request): void;
    public function deleteZipCode(Request $request):void;
}
