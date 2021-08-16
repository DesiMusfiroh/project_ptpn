<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faktur;
use App\Models\Sales;
use App\Models\Wilayah;
use App\Imports\FakturImport;
use App\Exports\FakturExport;
use App\Exports\FakturExportPerKeyword;
use Excel;

class FakturController extends Controller
{
    public function indexAdmin(Request $request)
    {
        $sales = Sales::all();
        $wilayah = Wilayah::all();

        if ($request->has('cari_sales')) {
            $faktur = Faktur::where('sales_id', $request->cari_sales)->paginate(10000);
            $count = $faktur->count();
        } elseif ($request->has('cari_wilayah')){
            $faktur = Faktur::where('wilayah_id', $request->cari_wilayah)->paginate(10000);
            $count = $faktur->count();
        } elseif ($request->has('cari')) {
            $faktur = Faktur::Where('no_faktur','LIKE','%'.$request->cari.'%')
                    ->orWhere('nama_outlet','LIKE','%'.$request->cari.'%')
                    ->orWhere('keyword','LIKE','%'.$request->cari.'%')->orderBy('tanggal_faktur', 'desc')->paginate(10000);
            $count = $faktur->count();
        } else {
            $faktur = Faktur::orderBy('tanggal_faktur', 'desc')->paginate(50);
            $count = Faktur::all()->count();
        }
        $keyword =  $bulan = Faktur::groupBy('keyword')->pluck('keyword');
        return view('admin.faktur',compact('faktur', 'sales', 'wilayah','count','keyword'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'no_faktur' => 'required',
            'date' => 'required',
            'sales_id' => 'required',
            'wilayah_id' => 'required',
            'nama_outlet' => 'required',
            'penjualan' => 'required',
            'cash_in' => 'required',
            'piutang' => 'required',
            'keyword' => 'required',
        ]);
       
        $day = substr($request->date, 0, 2);
        $month = substr($request->date, 3, 2);
        $year = substr($request->date, 6, 4);
        
        $date = date('Y-m-d', strtotime("$year-$month-$day"));
        $unix_date = strtotime($date);
        $tanggal_faktur = $unix_date/86400 + 25569;

        Faktur::create([
            'no_faktur' => $request->no_faktur,
            'tanggal_faktur' => $tanggal_faktur,
            'sales_id' => $request->sales_id,
            'wilayah_id' => $request->wilayah_id,
            'nama_outlet' => $request->nama_outlet,
            'penjualan' => $request->penjualan,
            'cash_in' => $request->cash_in,
            'piutang' => $request->piutang,
            'keyword' => $request->keyword,
        ]);
        
        return redirect()->back()->with('success','Data Faktur berhasil di tambahkan!');
    }

    public function importForm() {
        return view('admin.import');
    }

    public function exportForm() {
        $keyword = Faktur::groupBy('keyword')->get('keyword');
        return view('admin.export', compact('keyword'));
    }

    public function import(Request $request) {
        if (empty($request->file('file'))) {
            return back()->with('error','Pilih file excel terlebih dahulu');
        }
        else{   
            $import =  new FakturImport;
            $import->import($request->file('file')); 

            if($import->failures()->isNotEmpty()){
                $failures = $import->failures();     
                return redirect('/admin/faktur_import')->with('warning',"Data faktur gagal di masukkan!. Pastikan data sesuai dengan formatnya. ");
            }
            return redirect('/admin/faktur')->with('success','Data faktur berhasil di masukkan!');
        }
    }

    public function exportKeyword(Request $request) {
        $month = substr($request->keyword, 5, 2);
        $year = substr($request->keyword, 0, 4);
        $wilayah = substr($request->keyword, 8);
        $new_keyword = "$month-$year $wilayah";
        return Excel::download(new FakturExportPerKeyword($request), "Faktur $new_keyword.csv");
    }

    public function exportAll() {
        return Excel::download(new FakturExport, 'Data Faktur All.csv');
    }

    public function update(Request $request) {
        $faktur      = Faktur::findorFail($request->id);

        $day = substr($request->tanggal_faktur, 0, 2);
        $month = substr($request->tanggal_faktur, 3, 2);
        $year = substr($request->tanggal_faktur, 6, 4);
        
        $date = date('Y-m-d', strtotime("$year-$month-$day"));
        $unix_date = strtotime($date);
        $tanggal_faktur = $unix_date/86400 + 25569;

        $update_faktur = [
            'no_faktur' => $request->no_faktur,
            'tanggal_faktur' => $tanggal_faktur,
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

    public function deleteByKeywords(Request $request) {
        $deleteKeywords = $request->input('delete_keywords');
        foreach ($deleteKeywords as $keyword) {
            $faktur = Faktur::where('keyword', $keyword)->delete();
        }
        return redirect()->back()->with('success','Data Faktur berhasil di hapus!');
    }
}
