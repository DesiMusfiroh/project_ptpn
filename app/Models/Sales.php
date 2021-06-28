<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Sales;

class Sales extends Model
{
    protected $table ='sales';
    protected $fillable = ['id','nama','wilayah'];

}
