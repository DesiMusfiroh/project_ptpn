<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faktur;
use App\Models\Sales;
use App\Models\Wilayah;
use App\Imports\FakturImport;
use App\Exports\FakturExport;
use Excel;

class FakturController extends Controller
{
    public function indexAdmin(Request $request)
    {
        $sales = Sales::all();
        $wilayah = Wilayah::all();

        if ($request->has('cari_sales')) {
            $faktur = Faktur::where('sales_id', $request->cari_sales)->paginate(500);
        } elseif ($request->has('cari_wilayah')){
            $faktur = Faktur::where('wilayah_id', $request->cari_wilayah)->paginate(500);
        } elseif ($request->has('cari')) {
            $faktur = Faktur::where('tanggal_faktur','LIKE','%'.$request->cari.'%')
                    ->orWhere('no_faktur','LIKE','%'.$request->cari.'%')
                    ->orWhere('nama_outlet','LIKE','%'.$request->cari.'%')
                    ->orWhere('keyword','LIKE','%'.$request->cari.'%')->paginate(1000);
        } else {
            $faktur = Faktur::paginate(50);
        }
        $count = $faktur->count();
        return view('admin.faktur',compact('faktur', 'sales', 'wilayah','count'));
    }

    public function importForm() {
        return view('admin.import');
    }

    public function exportForm() {
        $keyword = Faktur::groupBy('keyword')->get('keyword');
        return view('admin.export', compact('keyword'));
    }

    public function import(Request $request) {
        Excel::import(new FakturImport, $request->file);
        return redirect('/admin/faktur')->with('success','Data faktur berhasil di masukkan!');
    }

    public function exportKeyword(Request $request) {
        return Excel::download(new FakturExport, "Faktur $request->keyword.csv");
    }

    public function exportAll() {
        return Excel::download(new FakturExport, 'Data Faktur All.csv');
    }

    public function update(Request $request)
    {
        $faktur      = Faktur::findorFail($request->id);
        $update_faktur = [
            'no_faktur' => $request->no_faktur,
            'tanggal_faktur' => $request->tanggal_faktur,
            'sales_id' => $request->sales_id,
            'wilayah_id' => $request->wilayah_id,
            'nama_outlet' => $request->nama_outlet,
            'penjualan' => $request->penjualan,
            'cash_in' => $request->cash_in,
            'piutang' => $request->piutang,
        ];
        $faktur->update($update_faktur);
        return redirect()->back()->with('success','Data Faktur berhasil di update!');
    }

    public function delete(Request $request)
    {
        $faktur = Faktur::findOrFail($request->id);
		$faktur->delete();
		return redirect()->back()->with('success','Data Faktur berhasil di hapus!');
    }
}
