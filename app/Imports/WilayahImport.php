<?php

namespace App\Imports;

use App\Models\Wilayah;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class WilayahImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $check_wilayah = Wilayah::where('nama', $row['nama'])->first();
        
        if (!$check_wilayah) {
            $posts = Wilayah::create([
                'nama'     => $row['nama'],
                'keterangan'  => $row['keterangan'],
            ]);  
        } 
        elseif ($check_wilayah) {
            $update_wilayah = [
                'nama'     => $row['nama'],
                'keterangan'  => $row['keterangan'],
            ];
            $posts = Wilayah::where('nama', $row['nama'])->update($update_wilayah);
        }
    }
}
