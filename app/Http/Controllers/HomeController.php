<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penjualan;
use App\Models\Sales;
use App\Models\Outlet;

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
        $penjualan = Penjualan::all();
        // $penjualan_per_sales = Penjualan::sum('penjualan')->groupByRaw('nama_sales')->get();
        // dd($penjualan_per_sales);
        return view('admin.dashboard');

        // total penjualan
        // total piutang 
        // total sales
        // total penjualan per bulan
        
    }
}
