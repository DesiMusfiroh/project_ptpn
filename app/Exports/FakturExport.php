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
            'kode_sales',
            'kode_wilayah',
            'nama_sales',
            'wilayah',
            'nama_outlet',
            'penjualan',
            'cash_in',
            'piutang',
            'keyword'
        ];
    }

    public function collection()
    {
        $faktur = Faktur::join('wilayah', 'wilayah.id', '=', 'faktur.wilayah_id')
                ->join('sales', 'sales.id', '=', 'faktur.sales_id')
                ->select('no_faktur','tanggal_faktur','sales.kode as kode_sales','wilayah.kode as kode_wilayah','sales.nama as nama_sales','wilayah.nama as wilayah','nama_outlet','penjualan','cash_in','piutang','keyword')->get();
        return $faktur;
    }
}
