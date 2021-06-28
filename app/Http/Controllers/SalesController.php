<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\SalesImport;
use App\Models\Sales;
use Excel;

class SalesController extends Controller
{
    public function indexAdmin()
    {
        $sales = Sales::all();
        return view('admin.sales',compact('sales'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'nama' => 'required',
            'wilayah' => 'required',
        ]);

        Sales::create([
            'nama' => $request->nama,
            'wilayah' => $request->wilayah,
        ]);
        
        return redirect('/admin/sales')
        ->with('success','Data Sales baru berhasil di tambahkan!');
    }

    public function update(Request $request)
    {
        $sales = Sales::findOrFail($request->id);
        $sales->update($request->all());
        return redirect()->back()->with('success','Data Sales berhasil di update!');
    }

    public function delete(Request $request)
    {
        $sales = Sales::findOrFail($request->id);
		$sales->delete();
		return redirect()->back()->with('success','Data Sales berhasil di hapus!');
    }

    public function importForm() {
        return view('sales-import');
    }

    public function import(Request $request) {
        Excel::import(new SalesImport, $request->file);
        return "Record sales berhasil di import";
    }
}
