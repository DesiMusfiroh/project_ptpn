<?php

namespace App\Exports;

use App\Models\Faktur;
use App\Models\Sales;
use App\Models\Wilayah;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class FakturExport implements FromCollection, WithHeadings
{
    public function headings():array {
        return [
            'no_faktur',
            'tanggal_faktur',
            'nama_sales',
            'wilayah',
            'nama_outlet',
            'penjualan',
            'cash_in',
            'piutang',
        ];
    }

    public function collection()
    {
        $faktur = Faktur::join('wilayah', 'wilayah.id', '=', 'faktur.wilayah_id')
                ->join('sales', 'sales.id', '=', 'faktur.sales_id')
                ->select('no_faktur','tanggal_faktur','sales_id','wilayah.nama','nama_outlet','penjualan','cash_in','piutang')->get();
        return $faktur;
    }
}
