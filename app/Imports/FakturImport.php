<?php

namespace App\Imports;

use App\Models\Faktur;
use App\Models\Sales;
use App\Models\Wilayah;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class FakturImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $sales = Sales::where('nama', $row['nama_sales'])->first();
        $wilayah = Wilayah::where('nama', $row['wilayah'])->first();
       
        $check_faktur = Faktur::where('no_faktur', $row['no_faktur'])->first();
        
        if (!$check_faktur) {
            $posts = Faktur::create([
                'no_faktur'         => $row['no_faktur'],
                'tanggal_faktur'    => $row['tanggal_faktur'],
                'sales_id'          => $sales->id,
                'wilayah_id'        => $wilayah->id,
                'nama_outlet'       => $row['nama_outlet'],
                'penjualan'         => $row['penjualan'],
                'cash_in'           => $row['cash_in'],
                'piutang'           => $row['piutang'],
            ]);  
        } 
        elseif ($check_faktur) {
            $update_faktur = [
                'no_faktur'         => $row['no_faktur'],
                'tanggal_faktur'    => $row['tanggal_faktur'],
                'sales_id'          => $sales->id,
                'wilayah_id'        => $wilayah->id,
                'nama_outlet'       => $row['nama_outlet'],
                'penjualan'         => $row['penjualan'],
                'cash_in'           => $row['cash_in'],
                'piutang'           => $row['piutang'],
            ];
            $posts = Faktur::where('no_faktur', $row['no_faktur'])->update($update_faktur);
        }
    }
}