<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Penjualan;

class Penjualan extends Model
{
    protected $table ='penjualan';
    protected $fillable = ['no_faktur','tanggal_faktur','nama_sales','nama_outlet','wilayah','penjualan','cash_in','piutang'];

    public static function getPenjualan() {
        $records = DB::table('penjualan')->select('id','no_faktur','tanggal_faktur','nama_sales','nama_outlet','wilayah','penjualan','cash_in','piutang');
        return $records;
    }
}
