<?php

namespace App\Imports;

use App\Penjualan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PenjualanImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Penjualan([
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
}
