<?php use App\Penjualan; use App\Sales;  ?>
@extends('layouts.layout_admin')

@section('content')
    <section style="padding-top:60px;">
        <div class="container">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header">
                        Import
                    </div>
                    <div class="card-body">
                        <form action="{{route('penjualan.import')}}" method="POST" enctype="multipart/form-data">
                            @csrf 
                            <div class="form-group">
                                <label for="file">Choose CSV</label>
                                <input type="file" name="file" class="form-control"/>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="row justify-content-center">
        <div class="col-md-10">
        <div class="card">

                <div class="card-header bg-dark text-center " style="font-size:20px; color:#c4eb2a; font-family:segoe ui black; font-weight:bold;"> 
                   <span>Data Penjualan</span>
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

                    <table class="table table-striped table-bordered table-sm">
                        <thead class="thead-light text-center">
                            <tr>
                                <th scope="col" style="width:50px">No</th>
                                <th scope="col" style="width:150px">Nomor Faktur</th>
                                <th scope="col" style="width:300px">Tanggal Faktur</th>
                                <th scope="col" style="width:300px">Nama Sales</th>
                                <th scope="col" style="width:300px">Nama Outlet</th>
                                <th scope="col" style="width:300px">Penjualan</th>
                                <th scope="col" style="width:300px">Cash in</th>
                                <th scope="col" style="width:300px">Piutang</th>
                              
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=0; ?>                                                 
                            @foreach ($penjualan as $item) 
                            <tr>
                                <td scope="row"><?php  $i++;  echo $i; ?></td>
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

                    <div class="row ">
                        <div class="col-12 text-center ">
                          
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
