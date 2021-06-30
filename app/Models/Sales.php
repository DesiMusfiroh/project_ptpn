<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Wilayah;
use App\Models\Faktur;
use App\Models\ViewRekapPerSales;

class Sales extends Model
{
    use HasFactory;
    protected $table ='sales';
    protected $fillable = ['kode','nama','wilayah'];
 
    public function wilayah() {
        return $this->belongsTo(Wilayah::class);
    }

    public function faktur() {
    	return $this->hasOne(Faktur::class,'sales_id');
    }
    
    public function rekap_per_sales() {
    	return $this->hasOne(ViewRekapPerSales::class,'sales_id');
    }
}
