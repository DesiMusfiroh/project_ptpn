<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    use HasFactory;
    protected $table ='sales';
    protected $fillable = ['nama','wilayah'];

    public static function getSales() {
        $records = DB::table('sales')->select('id','nama','wilayah');
        return $records;
    }
}
