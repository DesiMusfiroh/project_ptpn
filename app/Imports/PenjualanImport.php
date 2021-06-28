<?php

namespace App\Imports;

use App\Models\Penjualan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PenjualanImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $check_faktur = Penjualan::where('no_faktur', $row['no_faktur'])->first();
        
        if (!$check_faktur) {
            $posts = Penjualan::create([
                'no_faktur'         => $row['no_faktur'],
                'tanggal_faktur'    => $row['tanggal_faktur'],
                'nama_sales'        => $row['nama_sales'],
                'nama_outlet'       => $row['nama_outlet'],
                'wilayah'           => $row['wilayah'],
                'penjualan'         => $row['penjualan'],
                'cash_in'           => $row['cash_in'],
                'piutang'           => $row['piutang'],
            ]);  
        } 
        elseif ($check_faktur) {
            $update_faktur = [
                'no_faktur'         => $row['no_faktur'],
                'tanggal_faktur'    => $row['tanggal_faktur'],
                'nama_sales'        => $row['nama_sales'],
                'nama_outlet'       => $row['nama_outlet'],
                'wilayah'           => $row['wilayah'],
                'penjualan'         => $row['penjualan'],
                'cash_in'           => $row['cash_in'],
                'piutang'           => $row['piutang'],
            ];
            $posts = Penjualan::where('no_faktur', $row['no_faktur'])->update($update_faktur);
        }
    }
}
