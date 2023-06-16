<?php

namespace App\Http\Struct\Main\Setting\Service;

class SettingService
{
    public function index()
    {
        return setting()
            ->all();
    }

    public function update(array $data)
    {
        return setting($data)
            ->save();
    }
}
