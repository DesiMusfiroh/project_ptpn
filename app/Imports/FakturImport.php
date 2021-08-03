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
        if (Sales::where('kode', $row['kode_sales'])->doesntExist()) {
            Sales::create([
                'kode' => $row['kode_sales'],
                'nama' => $row['nama_sales'],
                'wilayah' => " ",
            ]);    
        }
        if (Wilayah::where('kode', $row['kode_wilayah'])->doesntExist()) {
            Wilayah::create([
                'kode' => $row['kode_wilayah'],
                'nama' => $row['wilayah'],
                'keterangan' => " ",
            ]);
        }

        $sales = Sales::where('kode', $row['kode_sales'])->first();
        $wilayah = Wilayah::where('kode', $row['kode_wilayah'])->first();

        $check_faktur = Faktur::where('no_faktur', $row['no_faktur'])->where('keyword', $row['keyword'])->first();
        
        $excel_timestamp = $row['tanggal_faktur']; 
        $php_timestamp = mktime(0,0,0,0,$excel_timestamp,1900); 
        $mysql_timestamp = date('d/m/Y', $php_timestamp);

        if (!$check_faktur) {
            $posts = Faktur::create([
                'no_faktur'         => $row['no_faktur'],
                'tanggal_faktur'    => $mysql_timestamp,
                'sales_id'          => $sales->id,
                'wilayah_id'        => $wilayah->id,
                'nama_outlet'       => $row['nama_outlet'],
                'penjualan'         => $row['penjualan'],
                'cash_in'           => $row['cash_in'],
                'piutang'           => $row['piutang'],
                'keyword'           => $row['keyword'],   
            ]);  
        } 
        elseif ($check_faktur) {
            $update_faktur = [
                'no_faktur'         => $row['no_faktur'],
                'tanggal_faktur'    => $mysql_timestamp,
                'sales_id'          => $sales->id,
                'wilayah_id'        => $wilayah->id,
                'nama_outlet'       => $row['nama_outlet'],
                'penjualan'         => $row['penjualan'],
                'cash_in'           => $row['cash_in'],
                'piutang'           => $row['piutang'],
                'keyword'           => $row['keyword'],   
            ];
            $posts = Faktur::where('no_faktur', $row['no_faktur'])->update($update_faktur);
        }
    }
}
