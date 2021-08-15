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

        if ($request->has('month') && $request->has('year')) {
            $chosen_month = "$request->year/$request->month";
            $rekap_bulan_sales = ViewRekapBulanSales::where('bulan','=',$chosen_month)->get();
            $rekap_bulan_wilayah = ViewRekapBulanWilayah::where('bulan','=',$chosen_month)->get();   
            $title = "Bulan $chosen_month ";
            $rekap_bulan = ViewRekapPerBulan::where('bulan', '=', $chosen_month)->first();
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

        $array_month  = collect([
            "01" => "Januari", 
            "02" => "Februari",
            "03" => "Maret",
            "04" => "April",
            "05" => "Mei",
            "06" => "Juni",
            "07" => "Juli",
            "08" => "Agustus",
            "09" => "September",
            "10" => "Oktober",
            "11" => "November",
            "12" => "Desember",
        ]);

        return view('welcome.bulanan', compact('bulan', 'title',
            'display_penjualan', 'display_cash_in', 'display_piutang',
            'rekap_bulan_sales','rekap_bulan_wilayah', 'array_month'))
            ->with('tabel_wilayah',json_encode($array_wilayah))
            ->with('tabel_sales', json_encode($array_sales));
    }

    public function harian(Request $request) {
        $current_day = date('d/m/Y');
       
        if ($request->has('date')) {
            $day = substr($request->date, 0, 2);
            $month = substr($request->date, 3, 2);
            $year = substr($request->date, 6, 4);
            
            $date = date('Y-m-d', strtotime("$year-$month-$day"));
            $unix_date = strtotime($date);
            $chosen_day = $unix_date/86400 + 25569;
            $faktur = Faktur::where('tanggal_faktur', $chosen_day)->get();
            $title = $request->date;
        } else {
            $faktur = Faktur::where('tanggal_faktur', $current_day)->get();
            $title = $current_day;
        }
        
        $display_penjualan = $faktur->sum('penjualan');
        $display_cash_in = $faktur->sum('cash_in');
        $display_piutang = $faktur->sum('piutang');
        return view('welcome.harian', compact('faktur','display_penjualan','display_cash_in','display_piutang','title'));
    }
}
