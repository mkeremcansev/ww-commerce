<?php

namespace App\Http\Struct\Main\Setting\Controller;

use App\Http\Controller;
use App\Http\Struct\Main\Setting\Request\SettingUpdateRequest;
use App\Http\Struct\Main\Setting\Service\SettingService;
use App\Response\ResponseHandler;
use Illuminate\Http\JsonResponse;

class SettingController extends Controller
{
    public function __construct(public SettingService $service)
    {
    }

    public function index(): JsonResponse
    {
        return ResponseHandler::successWithoutMessage($this->service->index());
    }

    public function update(SettingUpdateRequest $request): JsonResponse
    {
        $this->service->update($request->validated());

        return ResponseHandler::success();
    }
}
