@extends('layouts.master')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Dashboard Bulanan</h1>
    </div>

    <div class="section-body">

        <div class="row">
            <div class="col-lg-4">
              <div class="card gradient-bottom">
                <div class="card-header">
                  <h4>Rekapitulasi</h4>
                  <div class="card-header-action dropdown">
                    <a href="#" data-toggle="dropdown" class="btn btn-success dropdown-toggle">Bulan</a>
                    <ul class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                      <li class="dropdown-title">Pilih Bulan</li>
                        @foreach ($bulan as $item)
                        <li><a href="{{route('bulan',['pilih_bulan'=> $item])}}" class="dropdown-item">{{$item}}</a></li>
                        @endforeach
                    </ul>
                  </div>
                </div>
                <div class="card-body">
                  <ul class="list-unstyled list-unstyled-border">
                    <li class="media">
                      <img class="mr-3 rounded" width="55" src="../assets/img/products/product-3-50.png" alt="product">
                      <div class="media-body">
                        <div class="float-right"><div class="font-weight-600 text-muted text-small">86 Faktur</div></div>
                        <div class="media-title">Penjualan</div>
                        <div class="mt-1">
                            <h5>Rp. {{ number_format($rekap_per_bulan->penjualan) }}</h5>
                        </div>
                      </div>
                    </li>
                    <li class="media">
                      <img class="mr-3 rounded" width="55" src="../assets/img/products/product-4-50.png" alt="product">
                      <div class="media-body">
                        <div class="float-right"><div class="font-weight-600 text-muted text-small">67 Faktur</div></div>
                        <div class="media-title">Cash In</div>
                        <div class="mt-1">
                            <h5>Rp. {{ number_format($rekap_per_bulan->cash_in) }}</h5>
                        </div>
                    </li>
                    <li class="media">
                      <img class="mr-3 rounded" width="55" src="../assets/img/products/product-1-50.png" alt="product">
                      <div class="media-body">
                        <div class="float-right"><div class="font-weight-600 text-muted text-small">63 Faktur</div></div>
                        <div class="media-title">Piutang</div>
                        <div class="mt-1">
                            <h5>Rp. {{ number_format($rekap_per_bulan->piutang) }}</h5>
                        </div>
                      </div>
                    </li>
                  </ul>
                </div>
                <div class="card-footer pt-3 d-flex justify-content-center">
                  <div class="budget-price justify-content-center">
                    <div class="budget-price-square bg-primary" data-width="20"></div>
                    <div class="budget-price-label">Selling Price</div>
                  </div>
                  <div class="budget-price justify-content-center">
                    <div class="budget-price-square bg-danger" data-width="20"></div>
                    <div class="budget-price-label">Budget Price</div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h4>Rekap Sales {{$title}}</h4>
                    </div>
                    <div class="card-body p-0">

                    <div class="table-inside">
                        <table class="table table-striped table-md">
                        <thead>
                            <tr>
                                <th scope="col" style="width:50px" class="text-center">No</th>
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

                <div class="card">
                    <div class="card-header">
                        <h4>Rekap Wilayah {{$title}}</h4>
                    </div>
                    <div class="card-body p-0">

                    <div class="table-inside">
                        <table class="table table-striped table-md">
                        <thead>
                            <tr>
                                <th scope="col" style="width:50px" class="text-center">No</th>
                                <th scope="col" class="text-center">Wilayah</th>
                                <th scope="col" class="text-center">Penjualan</th>
                                <th scope="col" class="text-center">Cash in</th>
                                <th scope="col" class="text-center">Piutang</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=0; ?>                                                 
                            @foreach ($rekap_bulan_wilayah as $item) 
                            <tr>
                                <td scope="row" class="text-center"><?php  $i++;  echo $i; ?></td>
                                <td class="text-center">{{ $item->wilayah->nama }}</td>
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