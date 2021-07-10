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
            $faktur = Faktur::where('sales_id', $request->cari_sales)->paginate(10);
        }elseif ($request->has('cari_wilayah')){
            $faktur = Faktur::where('wilayah_id', $request->cari_wilayah)->paginate(10);
        }elseif ($request->has('cari')) {
            $faktur = Faktur::where('tanggal_faktur','LIKE','%'.$request->cari.'%')
                    ->orWhere('no_faktur','LIKE','%'.$request->cari.'%')
                    ->orWhere('nama_outlet','LIKE','%'.$request->cari.'%')->paginate(10);
        }
        // elseif ($request->has('cari_tanggal_faktur')) {
        //     $faktur = Faktur::where('tanggal_faktur','LIKE','%'.$request->cari_tanggal_faktur.'%')->all();
        // }elseif ($request->has('cari_no_faktur')) {
        //     $faktur = Faktur::where('no_faktur','LIKE','%'.$request->cari_no_faktur.'%')->all();
        // }
        else {
            $faktur = Faktur::paginate(10);
        }
        return view('admin.faktur',compact('faktur', 'sales', 'wilayah'));
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
