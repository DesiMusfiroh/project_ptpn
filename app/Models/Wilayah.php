<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Sales;
use App\Models\Faktur;

class Wilayah extends Model
{
    use HasFactory;
    protected $table ='wilayah';
    protected $fillable = ['nama','keterangan'];

    public function sales() {
    	return $this->hasOne(Sales::class,'wilayah_id');
    }

    public function faktur() {
    	return $this->hasOne(Faktur::class,'wilayah_id');
    }
}
