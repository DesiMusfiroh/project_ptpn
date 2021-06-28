<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Outlet;

class Outlet extends Model
{
    protected $table ='outlet';
    protected $fillable = ['id','nama','alamat','wilayah'];
    
}
