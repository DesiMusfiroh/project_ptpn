<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\WilayahImport;
use App\Models\Wilayah;
use Excel;

class WilayahController extends Controller
{
    public function indexAdmin()
    {
        $wilayah = Wilayah::all();
        return view('admin.wilayah',compact('wilayah'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'nama' => 'required',
        ]);

        Wilayah::create([
            'nama' => $request->nama,
            'keterangan' => $request->keterangan,
        ]);
        
        return redirect('/admin/wilayah')
        ->with('success','Data Wilayah berhasil di tambahkan!');
    }

    public function update(Request $request)
    {
        $wilayah = WIlayah::findOrFail($request->id);
        $wilayah->update($request->all());
        return redirect()->back()->with('success','Data Wilayah berhasil di update!');
    }

    public function delete(Request $request)
    {
        $wilayah = Wilayah::findOrFail($request->id);
		$wilayah->delete();
		return redirect()->back()->with('success','Data Wilayah berhasil di hapus!');
    }

    public function import(Request $request) {
        Excel::import(new WilayahImport, $request->file);
        return redirect()->back()->with('success','Data Wilayah berhasil di masukkan!');
    }
}
