<?php
namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithMappedCells;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\ToArray;

class ExcelImport implements WithHeadingRow, ToArray
{
    public function array(array $row)
    {
        return $row;
    }

}

