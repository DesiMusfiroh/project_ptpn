<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Penjualan extends Model
{
    protected $table ='penjualan';
    protected $fillable = ['no_faktur','tanggal_faktur','nama_sales','nama_outlet','wilayah','penjualan','cash_in','piutang'];
}
