<?php

namespace App\Helpers;


class GeneralHelper
{
    /**
     * @param $id
     * @param $sku
     * @return string
     */
    public static function skuGenerator($id, $sku): string
    {
        return rtrim($id . '-' . $sku, '-');
    }

    /**
     * @param $title
     * @param $sku
     * @return string
     */
    public static function skuTitleGenerator($title, $sku): string
    {
        return $title . ' ' . rtrim($sku, '-');
    }
}
