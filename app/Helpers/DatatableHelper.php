<?php

namespace App\Helpers;

use Exception;
use Illuminate\Support\Collection;
use Yajra\DataTables\DataTables;

class DatatableHelper
{
    /**
     * @param $request
     * @param $query
     * @return Collection
     */
    public static function filters($request, $query): Collection
    {
        return collect($request->validated())->map(function ($value, $key) use ($query) {
            switch ($value) {
                case null:
                    break;
                case is_array($value):
                    $query->whereIn($key, $value);
                    break;
                case is_int($value):
                    $query->where($key, $value);
                    break;
                case is_string($value):
                    $query->where($key, 'LIKE', "%{$value}%");
                    break;
            }
        });
    }

    /**
     * @param $request
     * @param $data
     * @return mixed
     * @throws Exception
     */
    public static function datatable($request, $data): mixed
    {
        return DataTables::of($data)
            ->filter(function ($query) use ($request) {
                return self::filters($request, $query);
            })
            ->make()
            ->getData()
            ->data;
    }
}
