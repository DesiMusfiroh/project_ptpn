<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Sales;
use App\Models\Faktur;
use App\Models\ViewRekapPerWilayah;

class Wilayah extends Model
{
    use HasFactory;
    protected $table ='wilayah';
    protected $fillable = ['kode','nama','keterangan'];

    public function faktur() {
    	return $this->hasOne(Faktur::class,'wilayah_id');
    }

    
    public function sales() {
    	return $this->hasOne(Sales::class,'wilayah_id');
    }

    public function rekap_per_wilayah() {
    	return $this->hasOne(ViewRekapPerWilayah::class,'wilayah_id');
    }

}
