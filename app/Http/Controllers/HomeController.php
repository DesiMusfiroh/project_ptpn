<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penjualan;
use App\Models\Sales;
use App\Models\Faktur;
use App\Models\ViewRekapPerSales;
use App\Models\ViewRekapPerWilayah;
use SweetAlert;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
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
        return view('admin.dashboard', compact('total_penjualan','total_cash_in','total_piutang','rekap_per_sales','rekap_per_wilayah'))->with('tabel_sales',json_encode($array_sales));

        // $faktur_per_sales  = $faktur->groupBy('sales_id')->map(function ($row) {
        //     return $row->sum('penjualan');
        // });
        // $faktur_per_wilayah  = $faktur->groupBy('wilayah_id')->map(function ($row) {
        //     return $row->sum('penjualan');
        // });
        // dd($faktur_per_wilayah);
    }
}
