<?php

namespace App\Exports;

use App\Models\Penjualan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PenjualanExport implements FromCollection, WithHeadings
{
    public function headings():array {
        return [
            'no_faktur',
            'tanggal_faktur',
            'nama_sales',
            'nama_outlet',
            'wilayah',
            'penjualan',
            'cash_in',
            'piutang',
        ];
    }

    public function collection()
    {
        return Penjualan::all('no_faktur','tanggal_faktur','nama_sales','nama_outlet','wilayah','penjualan','cash_in','piutang');
    }
}
