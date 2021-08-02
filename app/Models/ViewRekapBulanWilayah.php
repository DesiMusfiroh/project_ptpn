<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Wilayah;

class ViewRekapBulanWilayah extends Model
{
    use HasFactory;
    public $table = "rekap_bulan_wilayah";

    public function wilayah() {
        return $this->belongsTo(Wilayah::class);
    }
}
