<?php

namespace App\Http\Controllers\Main\Setting\Controller;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Main\Setting\Request\SettingUpdateRequest;
use App\Http\Controllers\Main\Setting\Service\SettingService;
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
