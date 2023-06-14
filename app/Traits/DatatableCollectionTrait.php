<?php

namespace App\Traits;

trait DatatableCollectionTrait
{
    public function datatables($request): array
    {
        return [
            'recordsTotal' => $this->recordsTotal ?? null,
            'recordsFiltered' => $this->recordsFiltered ?? null,
            'draw' => $request->draw ?? null,
            'queries' => $this->queries ?? null,
            'input' => $this->input ?? null,
        ];
    }
}
