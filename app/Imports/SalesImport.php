<?php

namespace App\Imports;

use App\Models\Sales;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SalesImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $check_sales = Sales::where('nama', $row['nama'])->first();
        
        if (!$check_sales) {
            $posts = Sales::create([
                'nama'     => $row['nama'],
                'wilayah'  => $row['wilayah'],
            ]);  
        } 
        elseif ($check_sales) {
            $update_sales = [
                'nama'     => $row['nama'],
                'wilayah'  => $row['wilayah'],
            ];
            $posts = Sales::where('nama', $row['nama'])->update($update_sales);
        }
    }
}
