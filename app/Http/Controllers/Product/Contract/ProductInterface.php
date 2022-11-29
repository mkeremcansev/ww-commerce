<?php

namespace App\Http\Controllers\Product\Contract;

interface ProductInterface
{
    /**
     * @param string $slug
     * @return mixed
     */
    public function productBySlug(string $slug): mixed;
}
