@extends('layouts.master')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Dashboard Bulanan</h1>
    </div>

    <div class="section-body">

        <div class="row mb-3">
            <div class="col-md-6">
            <form action="{{route('search')}}" method="GET">
                <div class="row">
                    <div class="col-md-3">
                    <label for="search">Pilih Bulan</label>
                    </div>
                    <div class="col-md-6">
                    <select name="cari" id="bulan" class="form-control">
                        <option value="">Pilih Bulan</option>
                        @foreach($bulan as $item)
                        <option value="{{ $item }}">{{$item}}</option>
                        @endforeach
                    </select>
                    </div>
                    <div class="col-md-3"> 
                    <button class="btn btn-success" type="submit">Submit</button>
                    </div>
                </div>
            </form>
            </div>
        </div>
        
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>{{$title}}</h4>
                    </div>
                    <div class="card-body">

                    <div class="table-inside">
                        <table class="table table-striped table-md">
                        <thead>
                            <tr>
                                <th scope="col" style="width:50px" class="text-center">No</th>
                                <th scope="col" class="text-center">Bulan</th>
                                <th scope="col" class="text-center">Nama Sales</th>
                                <th scope="col" class="text-center">Penjualan</th>
                                <th scope="col" class="text-center">Cash in</th>
                                <th scope="col" class="text-center">Piutang</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=0; ?>                                                 
                            @foreach ($rekap_bulan_sales as $item) 
                            <tr>
                                <td scope="row" class="text-center"><?php  $i++;  echo $i; ?></td>
                                <td class="text-center">{{ $item->bulan }}</td>
                                <td class="text-center">{{ $item->sales->nama }}</td>
                                <td class="text-center">Rp. {{ number_format($item->penjualan) }}</td>
                                <td class="text-center">Rp. {{ number_format($item->cash_in) }}</td>
                                <td class="text-center">Rp. {{ number_format($item->piutang) }}</td>          
                            </tr>
                            @endforeach 
                        </tbody>
                        </table>
                    </div>
                  
                  </div>
                </div>
            </div>
        </div>
        
    </div>
</section>

@endsection