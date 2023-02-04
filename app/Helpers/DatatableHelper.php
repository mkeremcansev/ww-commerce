<?php

namespace App\Helpers;

use Exception;
use Yajra\DataTables\DataTables;

class DatatableHelper
{
    /**
     * @param $data
     * @return mixed
     * @throws Exception
     */
    public static function datatable($data): mixed
    {
        return DataTables::of($data)
            ->make()
            ->getData();
    }
}
