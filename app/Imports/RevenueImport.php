<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class RevenueImport implements WithMultipleSheets
{

    public function sheets(): array
    {
        return [
            new ExcelImport()
        ];
    }
}