<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Sales;

class ViewRekapBulanSales extends Model
{
    use HasFactory;
    public $table = "rekap_bulan_sales";

    public function sales() {
        return $this->belongsTo(Sales::class);
    }
}
