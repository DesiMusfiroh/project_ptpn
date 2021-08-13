@extends('layouts.welcome')

@section('content')

<section class="section">
    <div class="section-header">
        <h1>Data Rekapitulasi Harian ({{$title}})</h1>
        <div class="section-header-breadcrumb">
            <form action="{{route('index.harian')}}" enctype="multipart/form-data"  method="get">
            <div class="input-group"> 
                <input class="form-control" name="date" placeholder="Pilih tanggal" type="text" required/>
                <button class="btn btn-primary " name="submit" type="submit">Submit</button>
            </div>
            </form>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                <i class="far fa-file"></i>
                </div>
                <div class="card-wrap">
                <div class="card-header">
                    <h4>Total Penjualan</h4>
                </div>
                <div class="card-body">
                    Rp. {{ number_format($display_penjualan) }}
                </div>
                </div>
            </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                <i class="far fa-file"></i>
                </div>
                <div class="card-wrap">
                <div class="card-header">
                    <h4>Total Cash In</h4>
                </div>
                <div class="card-body">
                    Rp. {{ number_format($display_cash_in) }}
                </div>
                </div>
            </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                <i class="far fa-file"></i>
                </div>
                <div class="card-wrap">
                <div class="card-header">
                    <h4>Total Piutang</h4>
                </div>
                <div class="card-body">
                    Rp. {{ number_format($display_piutang) }}
                </div>
                </div>
            </div>
            </div>    
        </div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-lg-12">
                <div class="card justify-content-center">
                    <div class="card-header"> 
                        <h4>Faktur Penjualan Harian</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-inside table-responsive">
                            <table class="table table-striped mb-0 table-bordered table-md">
                            <thead>
                                <tr>
                                    <th scope="col" style="width:50px">No</th>
                                    <th scope="col" class="text-center">Nomor Faktur</th>
                                    <th scope="col" class="text-center">Tanggal Faktur</th>
                                    <th scope="col" class="text-center">Nama Sales</th>
                                    <th scope="col" class="text-center">Wilayah</th>
                                    <th scope="col" class="text-center">Nama Outlet</th>
                                    <th scope="col" class="text-center" width="120px">Penjualan</th>
                                    <th scope="col" class="text-center" width="120px">Cash in</th>
                                    <th scope="col" class="text-center" width="120px">Piutang</th>
                                </tr>
                            </thead>
                            <tbody class="m-0 p-0">
                                    <?php $i=0; ?>                                                 
                                    @foreach ($faktur as $item) 
                                    <tr>
                                        <td scope="row" class="text-center"><?php  $i++;  echo $i; ?></td>
                                        <td class="text-center">{{ $item->no_faktur }}</td>
                                        <td class="text-center">
                                            <?php 
                                                $excel_timestamp = $item->tanggal_faktur;
                                                $unix_date = ($excel_timestamp - 25569) * 86400;
                                                $date = date("d/m/Y", $unix_date);
                                            ?>
                                        {{ $date }}
                                        </td>
                                        <td class="text-center">{{ $item->sales->kode }}</td> 
                                        <td class="text-center">{{ $item->wilayah->nama }}</td> 
                                        <td class="text-center">{{ $item->nama_outlet }}</td>
                                        <td class="text-center">{{ number_format($item->penjualan) }}</td>
                                        <td class="text-center">{{ number_format($item->cash_in) }}</td>
                                        <td class="text-center">{{ number_format($item->piutang) }}</td> 
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

<!-- Include jQuery -->
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

<!-- Include Date Range Picker -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>

<script>
    $(document).ready(function(){
      var date_input=$('input[name="date"]'); //our date input has the name "date"
      var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
      var options={
        format: 'dd/mm/yyyy',
        container: container,
        todayHighlight: true,
        autoclose: true,
      };
      date_input.datepicker(options);
    })
</script>
@endsection