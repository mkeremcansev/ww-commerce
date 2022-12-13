<?php

namespace App\Helpers;

use Exception;
use Illuminate\Support\Collection;
use Yajra\DataTables\DataTables;

class DatatableHelper
{
    /**
     * @param $query
     * @return Collection
     */
    public static function filters($query): Collection
    {
        return collect(request()->all())->map(function ($value, $key) use ($query) {
            switch ($value) {
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
     * @param $data
     * @return mixed
     * @throws Exception
     */
    public static function datatable($data): mixed
    {
        return DataTables::of($data)
            ->filter(function ($query) {
                return self::filters($query);
            })
            ->make()
            ->getData()
            ->data;
    }
}
