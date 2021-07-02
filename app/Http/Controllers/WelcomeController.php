<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sales;
use App\Models\Faktur;
use App\Models\ViewRekapPerSales;
use App\Models\ViewRekapPerWilayah;
use App\Models\ViewRekapPerBulan;

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
        return view('welcome', compact('total_penjualan','total_cash_in','total_piutang','rekap_per_sales','rekap_per_wilayah','rekap_per_bulan'))
        ->with('tabel_sales', json_encode($array_sales))
        ->with('tabel_wilayah',json_encode($array_wilayah))
        ->with('tabel_bulan',json_encode($array_bulan));

    }
}
