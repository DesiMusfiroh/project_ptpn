<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Sales;
use App\Models\Wilayah;

class Faktur extends Model
{
    protected $table ='faktur';
    protected $fillable = ['no_faktur','tanggal_faktur','sales_id','wilayah_id','nama_outlet','penjualan','cash_in','piutang'];

    public function wilayah() {
        return $this->belongsTo(Wilayah::class);
    }

    public function sales() {
        return $this->belongsTo(Sales::class);
    }
}
