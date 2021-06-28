<?php

namespace App\Imports;

use App\Sales;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SalesImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Sales([
            'nama'         => $row['nama'],
            'wilayah'    => $row['wilayah'],
        ]);
    }
}
