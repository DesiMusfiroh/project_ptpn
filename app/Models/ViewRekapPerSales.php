<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Sales;

class ViewRekapPerSales extends Model
{
    use HasFactory;
    public $table = "rekap_per_sales";

    public function sales() {
        return $this->belongsTo(Sales::class);
    }
}
