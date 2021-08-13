@extends('layouts.welcome')

@section('content')

<section class="section">
    <div class="section-header">
        <h1>Data Rekapitulasi Piutang {{$title}}</h1>
        <div class="section-header-breadcrumb">
        <form action="{{route('index.bulanan')}}" enctype="multipart/form-data"  method="get">
            <div class="form-group mb-0">
                <div class="input-group mb-0">
                <select class="custom-select" name="month" required>
                    <option selected value="__">Pilih bulan </option>
                    @foreach ($array_month as $key => $item)
                        <option value="{{$key}}">{{$item}}</option>
                    @endforeach
                </select>
                <input type="number" class="form-control" placeholder="Masukkan tahun" name="year" required>
                <button class="btn btn-primary" type="submit">Submit</button>
                </div>
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
                    Rp. {{ number_format($display_penjualan)}}
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
                    Rp. {{ number_format($display_cash_in)}}
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
                    Rp. {{ number_format($display_piutang)}}
                </div>
                </div>
            </div>
            </div>    
        </div>

        <div class="row">
            <div class="col-md-7 col-sm-12 col-lg-7">
                <div class="card justify-content-center">
                    <div class="card-header"> 
                        <h4>Grafik Rekapitulasi Piutang Penjualan Sales {{$title}}</h4>
                    </div>
                    <div class="card-body mr-3 ml-3">
                        <div id="chart_rekap_per_sales" style="height: 300px;"></div>
                    </div>
                </div>    
            </div>
            <div class="col-md-5 col-sm-12 col-lg-5">
                <div class="card justify-content-center">
                    <div class="card-header"> 
                        <h4>Grafik Rekapitulasi Per Wilayah</h4>
                    </div>
                    <div class="card-body mr-3 ml-3">
                        <div id="chart_rekap_per_wilayah" style="height: 300px;"></div>
                    </div>                 
                </div>    
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Rekap Sales {{$title}}</h4>
                    </div>
                    <div class="card-body p-0">

                    <div class="table-inside">
                        <table class="table table-striped table-md">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center">Nama Sales</th>
                                <th scope="col" class="text-center">Penjualan</th>
                                <th scope="col" class="text-center">Cash in</th>
                                <th scope="col" class="text-center">Piutang</th>
                            </tr>
                        </thead>
                        <tbody>                                     
                            @foreach ($rekap_bulan_sales as $item) 
                            <tr>
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

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Rekap Wilayah {{$title}}</h4>
                    </div>
                    <div class="card-body p-0">

                    <div class="table-inside">
                        <table class="table table-striped table-md">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center">Wilayah</th>
                                <th scope="col" class="text-center">Penjualan</th>
                                <th scope="col" class="text-center">Cash in</th>
                                <th scope="col" class="text-center">Piutang</th>
                            </tr>
                        </thead>
                        <tbody>                                               
                            @foreach ($rekap_bulan_wilayah as $item) 
                            <tr>
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

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">

    var analytics_wilayah = <?php echo $tabel_wilayah; ?>;
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

      var data = new google.visualization.arrayToDataTable(analytics_wilayah);    
      var options = {
          chart: {
            title: '',      
          },
          colors: ['blue', 'green', 'orange']
        };
      var chart = new google.charts.Bar(document.getElementById('chart_rekap_per_wilayah'));
      chart.draw(data, google.charts.Bar.convertOptions(options));
    }
</script>

<script type="text/javascript">

      var analytics_sales = <?php echo $tabel_sales; ?>;
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

      var data = new google.visualization.arrayToDataTable(analytics_sales);    
      var options = {
          chart: {
            title: ' ',      
          },
          colors: ['blue', 'green', 'orange']
        };
      var chart = new google.charts.Bar(document.getElementById('chart_rekap_per_sales'));
      chart.draw(data, google.charts.Bar.convertOptions(options));

    }
</script>

 <!-- JS Libraies -->
  <script src="../node_modules/bootstrap-daterangepicker/daterangepicker.js"></script>
  <script src="../node_modules/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>

  <!-- Page Specific JS File -->
  <script src="../assets/js/page/forms-advanced-forms.js"></script>

@endsection