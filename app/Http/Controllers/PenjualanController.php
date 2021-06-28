<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\PenjualanImport;
use App\Models\Penjualan;
use Excel;

class PenjualanController extends Controller
{
    public function indexAdmin()
    {
        $penjualan = Penjualan::all();
        return view('admin.penjualan',compact('penjualan'));
    }

    public function importForm() {
        return view('import-form');
    }

    public function import(Request $request) {
        Excel::import(new PenjualanImport, $request->file);
        return "Record berhasil di import";
    }
}
