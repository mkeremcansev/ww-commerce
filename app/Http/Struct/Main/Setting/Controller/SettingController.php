<?php

namespace App\Http\Struct\Main\Setting\Controller;

use App\Helpers\EnumerationHelper;
use App\Http\Controller;
use App\Http\Struct\Main\Setting\Enumeration\SettingMimeTypeEnumeration;
use App\Http\Struct\Main\Setting\Request\SettingUpdateRequest;
use App\Http\Struct\Main\Setting\Service\SettingService;
use App\Response\ResponseHandler;
use Illuminate\Http\JsonResponse;
use ReflectionException;

class SettingController extends Controller
{
    public function __construct(public SettingService $service)
    {
    }

    public function index()
    {
        return $this->service->index();
    }

    /**
     * @throws ReflectionException
     */
    public function edit(): array
    {
        return [
            'mime_types' => EnumerationHelper::enumerationToArray(SettingMimeTypeEnumeration::class),
            'data' => $this->service->index(),
        ];
    }

    public function update(SettingUpdateRequest $request): JsonResponse
    {
        $this->service->update($request->validated());

        return ResponseHandler::success();
    }
}
