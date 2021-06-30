<?php

namespace App\Imports;

use App\Models\Sales;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SalesImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $check_sales = Sales::where('kode', $row['kode'])->first();
        
        if (!$check_sales) {
            $posts = Sales::create([
                'kode'     => $row['kode'],
                'nama'     => $row['nama'],
                'wilayah'  => $row['wilayah'],
            ]);  
        } 
        elseif ($check_sales) {
            $update_sales = [
                'kode'     => $row['kode'],
                'nama'     => $row['nama'],
                'wilayah'  => $row['wilayah'],
            ];
            $posts = Sales::where('kode', $row['kode'])->update($update_sales);
        }
    }
}
