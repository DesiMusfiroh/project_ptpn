<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\SalesImport;
use App\Models\Sales;
use App\Models\Wilayah;
use Excel;

class SalesController extends Controller
{
    public function indexAdmin()
    {
        $sales = Sales::paginate(8);
        $wilayah = Wilayah::all();
        return view('admin.sales',compact('sales','wilayah'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'kode' => 'required',
            'nama' => 'required',
            'wilayah' => 'required',
        ]);

        Sales::create([
            'kode' => $request->kode,
            'nama' => $request->nama,
            'wilayah' => $request->wilayah,
        ]);

        return redirect('/admin/sales')->with('success', 'Data sales berhasil ditambahkan!');
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

    public function import(Request $request) {
        Excel::import(new SalesImport, $request->file);
        return redirect()->back()->with('success','Data Sales berhasil di masukkan!');
    }
}
