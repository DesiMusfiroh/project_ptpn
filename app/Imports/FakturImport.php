<?php

namespace App\Imports;

use App\Models\Faktur;
use App\Models\Sales;
use App\Models\Wilayah;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class FakturImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnError, SkipsOnFailure 
{
    use Importable,SkipsErrors, SkipsFailures;
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
                'keyword'           => $row['keyword'],   
            ]);  
        } 
        elseif ($check_faktur) {
            $update_faktur = [
                'tanggal_faktur'    => $row['tanggal_faktur'],
                'sales_id'          => $sales->id,
                'wilayah_id'        => $wilayah->id,
                'nama_outlet'       => $row['nama_outlet'],
                'penjualan'         => $row['penjualan'],
                'cash_in'           => $row['cash_in'],
                'piutang'           => $row['piutang'],
            ];
            $posts = Faktur::where('no_faktur', strval($row['no_faktur']))->where('keyword', $row['keyword'])->update($update_faktur);
        }
            
    }

    public function getRowCount(): int
    {
        return $this->rows;
    }    

    public function rules(): array 
    {
        return [
            '*.no_faktur' => ['required'],
            '*.tanggal_faktur' => ['required', 'integer'],
            '*.kode_sales' => ['required'],
            '*.kode_wilayah' => ['required'],
            '*.keyword' => ['required'],
            '*.penjualan' => ['integer'],
            '*.cash_in' => ['integer'],
            '*.piutang' => ['integer'],
        ];
    }     
}
