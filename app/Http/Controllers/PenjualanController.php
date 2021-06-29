<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penjualan;
use App\Imports\PenjualanImport;
use App\Exports\PenjualanExport;
use Excel;

class PenjualanController extends Controller
{
    public function indexAdmin()
    {
        $penjualan = Penjualan::all();
        return view('admin.penjualan',compact('penjualan'));
    }

    public function importForm() {
        return view('admin.import');
    }

    public function import(Request $request) {
        Excel::import(new PenjualanImport, $request->file);
        return redirect('/admin/penjualan')->with('success','Data penjualan berhasil di masukkan!');
    }

    public function export() {
        return Excel::download(new PenjualanExport, 'data_penjualan.csv');
    }
}
