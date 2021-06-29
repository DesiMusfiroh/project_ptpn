<?php use App\Penjualan; use App\Sales;  ?>
@extends('layouts.master')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Data Penjualan</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header mb-0">
                        <h4>List Penjualan</h4>
                    </div>
                    <div class="card-body">
                    
                    @if ($message = Session::get('success'))               
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif
                        
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif  

                    <div class="table-inside">
                        <table class="table table-striped table-md">
                        <thead>
                            <tr>
                                <th scope="col" style="width:50px">No</th>
                                <th scope="col" class="text-center">Nomor Faktur</th>
                                <th scope="col" class="text-center">Tanggal Faktur</th>
                                <th scope="col" class="text-center">Nama Sales</th>
                                <th scope="col" class="text-center">Nama Outlet</th>
                                <th scope="col" class="text-center">Penjualan</th>
                                <th scope="col" class="text-center">Cash in</th>
                                <th scope="col" class="text-center">Piutang</th>
                            </tr>
                        </thead>
                        <tbody>
                                <?php $i=0; ?>                                                 
                                @foreach ($penjualan as $item) 
                                <tr>
                                    <td scope="row" class="text-center"><?php  $i++;  echo $i; ?></td>
                                    <td class="text-center">{{ $item->no_faktur }}</td>
                                    <td class="text-center">{{ $item->tanggal_faktur }}</td>
                                    <td class="text-center">{{ $item->nama_sales }}</td> 
                                    <td class="text-center">{{ $item->nama_outlet }}</td>
                                    <td class="text-center">{{ $item->penjualan }}</td>
                                    <td class="text-center">{{ $item->cash_in }}</td>
                                    <td class="text-center">{{ $item->piutang}}</td>          
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
