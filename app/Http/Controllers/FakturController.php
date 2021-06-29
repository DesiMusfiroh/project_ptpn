<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faktur;
use App\Imports\FakturImport;
use App\Exports\FakturExport;
use Excel;

class FakturController extends Controller
{
    public function indexAdmin()
    {
        $faktur = Faktur::all();
        return view('admin.faktur',compact('faktur'));
    }

    public function importForm() {
        return view('admin.import');
    }

    public function import(Request $request) {
        Excel::import(new FakturImport, $request->file);
        return redirect('/admin/faktur')->with('success','Data faktur berhasil di masukkan!');
    }

    public function export() {
        return Excel::download(new FakturExport, 'data_faktur.csv');
    }
}
