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
use Carbon\Carbon;

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
        // $testdate = Carbon::parse(42322)->format('d/m/Y');
        // $testdate = date("Y-m-d ", 1388516401);

        $excel_timestamp = 44180; 
        $php_timestamp = mktime(0,0,0,0,$excel_timestamp,1900); 
        $mysql_timestamp = date('d/m/Y', $php_timestamp);

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

    public function bulan(Request $request) {
        $current_month = date('m/Y');
               
        if ($request->has('pilih_bulan')) {
            $rekap_bulan_sales = ViewRekapBulanSales::where('bulan','=',$request->pilih_bulan)->get();
            $rekap_bulan_wilayah = ViewRekapBulanWilayah::where('bulan','=',$request->pilih_bulan)->get();   
            $title = "Bulan $request->pilih_bulan ";
            $rekap_bulan = ViewRekapPerBulan::where('bulan', '=', $request->pilih_bulan)->first();
         
        }else {
            $rekap_bulan_sales = ViewRekapBulanSales::where('bulan','=', '08/2020')->get();           
            $rekap_bulan_wilayah = ViewRekapBulanWilayah::where('bulan','=', '08/2020')->get();       
            $title = "Bulan 08/2020";
            $rekap_bulan = ViewRekapPerBulan::where('bulan', '=', '08/2020')->first();
        }
        $display_penjualan = $rekap_bulan->penjualan;
        $display_cash_in = $rekap_bulan->cash_in;
        $display_piutang = $rekap_bulan->piutang;

        $bulan = ViewRekapBulanSales::groupBy('bulan')->pluck('bulan');
        return view('admin.bulan', compact('bulan', 'title',
            'display_penjualan', 'display_cash_in', 'display_piutang',
            'rekap_bulan_sales','rekap_bulan_wilayah'));
    }
}
