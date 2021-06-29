<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Wilayah;
use App\Models\Faktur;

class Sales extends Model
{
    use HasFactory;
    protected $table ='sales';
    protected $fillable = ['nama','wilayah'];
 
    public function wilayah() {
        return $this->belongsTo(Wilayah::class);
    }

    public function faktur() {
    	return $this->hasOne(Faktur::class,'sales_id');
    }

    // public static function getSales() {
    //     $records = DB::table('sales')->select('id','nama','wilayah_id');
    //     return $records;
    // }

}
