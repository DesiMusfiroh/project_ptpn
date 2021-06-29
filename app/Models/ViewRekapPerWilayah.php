<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Wilayah;

class ViewRekapPerWilayah extends Model
{
    use HasFactory;
    public $table = "rekap_per_wilayah";

    public function wilayah() {
        return $this->belongsTo(Wilayah::class);
    }
    
}
