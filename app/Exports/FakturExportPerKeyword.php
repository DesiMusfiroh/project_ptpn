<?php

namespace App\Exports;

use App\Models\Faktur;
use App\Models\Sales;
use App\Models\Wilayah;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class FakturExportPerKeyword implements FromCollection, WithHeadings
{
    public function __construct($request)
    {
        $this->request = $request;
    }
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
            'keyword',
        ];
    }

    public function collection()
    {
        $faktur = Faktur::rightJoin('sales', 'faktur.sales_id', '=', 'sales.id')
                ->join('wilayah', 'wilayah.id', '=', 'faktur.wilayah_id')
                ->select('no_faktur','tanggal_faktur','sales.kode','wilayah.kode','sales.nama','wilayah.nama','nama_outlet','penjualan','cash_in','piutang','keyword')
                ->where('keyword', $this->request->keyword)->get();
        return $faktur;
    }
}
