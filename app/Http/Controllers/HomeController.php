<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sales;
use App\Models\Faktur;
use App\Models\ViewRekapPerSales;
use App\Models\ViewRekapPerWilayah;
use App\Models\ViewRekapPerBulan;
use App\Models\ViewRekapBulanSales;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $total_penjualan = Faktur::sum('penjualan');
        $total_cash_in = Faktur::sum('cash_in');
        $total_piutang = Faktur::sum('piutang');

        $rekap_per_sales = ViewRekapPerSales::all();
        $array_sales[] = ['Sales','Penjualan','Cash In', 'Piutang'];
        foreach($rekap_per_sales as $key => $value) {
            $array_sales[++$key] = [$value->sales->nama, 
            floatval($value->penjualan), 
            floatval($value->cash_in),
            floatval($value->piutang)];
        }
        
        $rekap_per_wilayah = ViewRekapPerWilayah::all();
        $array_wilayah[] = ['Wilayah','Penjualan','Cash In', 'Piutang'];
        foreach($rekap_per_wilayah as $key => $value) {
            $array_wilayah[++$key] = [$value->wilayah->nama, 
            floatval($value->penjualan), 
            floatval($value->cash_in),
            floatval($value->piutang)];
        }

        $rekap_per_bulan = ViewRekapPerBulan::all();
        $array_bulan[] = ['Bulan','Penjualan','Cash In', 'Piutang'];
        foreach($rekap_per_bulan as $key => $value) {
            $array_bulan[++$key] = [$value->bulan, 
            floatval($value->penjualan), 
            floatval($value->cash_in),
            floatval($value->piutang)];
        }
        return view('admin.dashboard', compact('total_penjualan','total_cash_in','total_piutang','rekap_per_sales','rekap_per_wilayah','rekap_per_bulan'))
        ->with('tabel_sales', json_encode($array_sales))
        ->with('tabel_wilayah',json_encode($array_wilayah));
        // $faktur_per_sales  = $faktur->groupBy('sales_id')->map(function ($row) {
        //     return $row->sum('penjualan');
        // });
        // $faktur_per_wilayah  = $faktur->groupBy('wilayah_id')->map(function ($row) {
        //     return $row->sum('penjualan');
        // });
        // dd($faktur_per_wilayah);
    }

    public function search(Request $request) {
        if ($request->has('cari')) {
            $rekap_bulan_sales = ViewRekapBulanSales::where('bulan','=',$request->cari)->get();
            $title = "Bulan $request->cari ";
        }else {
            $rekap_bulan_sales = ViewRekapBulanSales::all();            
            $title = "Bulan ";
        }

        $bulan = ViewRekapBulanSales::groupBy('bulan')->pluck('bulan');
 
        return view('admin.search', compact('rekap_bulan_sales','bulan', 'title'));
    }
}
