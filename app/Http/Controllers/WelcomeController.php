<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sales;
use App\Models\Faktur;
use App\Models\ViewRekapPerSales;
use App\Models\ViewRekapPerWilayah;
use App\Models\ViewRekapPerBulan;
use App\Models\ViewRekapBulanSales;
use App\Models\ViewRekapBulanWilayah;

class WelcomeController extends Controller
{
    public function index() {
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
        return view('welcome.index', compact('total_penjualan','total_cash_in','total_piutang','rekap_per_sales','rekap_per_wilayah','rekap_per_bulan'))
        ->with('tabel_sales', json_encode($array_sales))
        ->with('tabel_wilayah',json_encode($array_wilayah))
        ->with('tabel_bulan',json_encode($array_bulan));

    }

    public function bulanan(Request $request) {
        $current_month = date('m/Y');

        if ($request->has('pilih_bulan')) {
            $rekap_bulan_sales = ViewRekapBulanSales::where('bulan','=',$request->pilih_bulan)->get();
            $rekap_bulan_wilayah = ViewRekapBulanWilayah::where('bulan','=',$request->pilih_bulan)->get();   
            $title = "Bulan $request->pilih_bulan ";
            $rekap_bulan = ViewRekapPerBulan::where('bulan', '=', $request->pilih_bulan)->first();
        }else {
            $rekap_bulan_sales = ViewRekapBulanSales::where('bulan','=', $current_month)->get();           
            $rekap_bulan_wilayah = ViewRekapBulanWilayah::where('bulan','=', $current_month)->get();       
            $title = "Bulan  $current_month";
            $rekap_bulan = ViewRekapPerBulan::where('bulan', '=', $current_month)->first();

        }

        if($rekap_bulan == null) {
            $display_penjualan = 0;
            $display_cash_in = 0;
            $display_piutang = 0;    
        } else {
            $display_penjualan = $rekap_bulan->penjualan;
            $display_cash_in = $rekap_bulan->cash_in;
            $display_piutang = $rekap_bulan->piutang;
        }
        $bulan = ViewRekapBulanSales::groupBy('bulan')->pluck('bulan');

        $array_wilayah[] = ['Wilayah','Penjualan','Cash In', 'Piutang'];
        foreach($rekap_bulan_wilayah as $key => $value) {
            $array_wilayah[++$key] = [$value->wilayah->nama, 
            floatval($value->penjualan), 
            floatval($value->cash_in),
            floatval($value->piutang)];
        }

        $array_sales[] = ['Sales','Penjualan','Cash In', 'Piutang'];
        foreach($rekap_bulan_sales as $key => $value) {
            $array_sales[++$key] = [$value->sales->nama, 
            floatval($value->penjualan), 
            floatval($value->cash_in),
            floatval($value->piutang)];
        }

        return view('welcome.bulanan', compact('bulan', 'title',
            'display_penjualan', 'display_cash_in', 'display_piutang',
            'rekap_bulan_sales','rekap_bulan_wilayah'))
            ->with('tabel_wilayah',json_encode($array_wilayah))
            ->with('tabel_sales', json_encode($array_sales));
    }

    public function harian() {
        return view('welcome.harian');
    }
}
