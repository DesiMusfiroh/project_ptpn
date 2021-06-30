<?php

namespace App\Imports;

use App\Models\Wilayah;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class WilayahImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $check_wilayah = Wilayah::where('kode', $row['kode'])->first();
        
        if (!$check_wilayah) {
            $posts = Wilayah::create([
                'kode'     => $row['kode'],
                'nama'     => $row['nama'],
                'keterangan'  => $row['keterangan'],
            ]);  
        } 
        elseif ($check_wilayah) {
            $update_wilayah = [
                'kode'     => $row['kode'],
                'nama'     => $row['nama'],
                'keterangan'  => $row['keterangan'],
            ];
            $posts = Wilayah::where('kode', $row['kode'])->update($update_wilayah);
        }
    }
}
