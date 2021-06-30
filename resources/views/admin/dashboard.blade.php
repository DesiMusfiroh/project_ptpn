@extends('layouts.master')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Dashboard Admin</h1>
    </div>

    <div class="section-body">

      <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-icon bg-primary">
              <i class="far fa-user"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Total Penjualan</h4>
              </div>
              <div class="card-body">
                Rp. {{ number_format($total_penjualan)}}
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-icon bg-success">
              <i class="fas fa-circle"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Total Cash In</h4>
              </div>
              <div class="card-body">
                Rp. {{ number_format($total_cash_in)}}
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
                Rp. {{ number_format($total_piutang)}}
              </div>
            </div>
          </div>
        </div>    
      </div>

      <div class="row">
        <div class="col-md-6">
            <div class="card justify-content-center">
                <div class="card-header"> 
                    <h4>Grafik Rekapitulasi Per Sales</h4>
                </div>
                <div class="card-body mr-3 ml-3">
                    <div id="chart_rekap_per_sales" style="height: 200px;"></div>
                </div>
                
            </div>    
        </div>

        <div class="col-md-6">
            <div class="card justify-content-center">
                <div class="card-header"> 
                    <h4>Grafik Rekapitulasi Per Wilayah</h4>
                </div>
                <div class="card-body mr-3 ml-3">
                    <div id="chart_rekap_per_wilayah" style="height: 200px;"></div>
                </div>
                
            </div>    
        </div>
      </div>
      
      <div class="row">
        <div class="col-md-8">
          <div class="card">
            <div class="card-header">
              <h4>Rekap Data Per Sales</h4>
            </div>
            <div class="card-body">
              <div class="table-inside">
                  <table class="table table-striped table-md">
                      <thead>
                          <tr>
                          <th scope="col" class="text-center">No</th>
                          <th scope="col" class="text-center">Nama Sales</th>
                          <th scope="col" class="text-center">Penjualan</th>
                          <th scope="col" class="text-center">Cash In</th>
                          <th scope="col" class="text-center">Piutang</th>
                          </tr>
                      </thead>
                      <tbody>
                          <?php $i=0; ?>                                                 
                          @foreach ($rekap_per_sales as $item) 
                          <tr>
                              <td scope="row" class="text-center"><?php  $i++;  echo $i; ?></td>
                              <td scope="row">{{ $item->sales->nama }}</td>
                              <td scope="row" >Rp. {{ number_format($item->penjualan) }}</td>
                              <td scope="row" >Rp. {{ number_format($item->cash_in) }}</td>
                              <td scope="row" >Rp {{ number_format($item->piutang) }}</td>
                          </tr>
                          @endforeach 
                      </tbody>
                  </table>
              </div>
            </div>
          </div>
        </div>
      </div>
  
      <div class="row">
        <div class="col-md-8">
          <div class="card">
            <div class="card-header">
              <h4>Rekap Data Per Wilayah</h4>
            </div>
            <div class="card-body">
              <div class="table-inside">
                  <table class="table table-striped table-md">
                      <thead>
                          <tr>
                          <th scope="col" class="text-center">No</th>
                          <th scope="col" class="text-center">Wilayah</th>
                          <th scope="col" class="text-center">Penjualan</th>
                          <th scope="col" class="text-center">Cash In</th>
                          <th scope="col" class="text-center">Piutang</th>
                          </tr>
                      </thead>
                      <tbody>
                          <?php $i=0; ?>                                                 
                          @foreach ($rekap_per_wilayah as $item) 
                          <tr>
                              <td scope="row" class="text-center"><?php  $i++;  echo $i; ?></td>
                              <td scope="row">{{ $item->wilayah->nama }}</td>
                              <td scope="row" >Rp. {{ number_format($item->penjualan) }}</td>
                              <td scope="row" >Rp. {{ number_format($item->cash_in) }}</td>
                              <td scope="row" >Rp {{ number_format($item->piutang) }}</td>
                          </tr>
                          @endforeach 
                      </tbody>
                  </table>
              </div>
            </div>
          </div>
        </div>
      </div>
     
      <div class="row">
        <div class="col-md-8">
          <div class="card">
            <div class="card-header">
              <h4>Rekap Data Per Bulan</h4>
            </div>
            <div class="card-body">
              <div class="table-inside">
                  <table class="table table-striped table-md">
                      <thead>
                          <tr>
                          <th scope="col" class="text-center">No</th>
                          <th scope="col" class="text-center">Bulan</th>
                          <th scope="col" class="text-center">Penjualan</th>
                          <th scope="col" class="text-center">Cash In</th>
                          <th scope="col" class="text-center">Piutang</th>
                          </tr>
                      </thead>
                      <tbody>
                          <?php $i=0; ?>                                                 
                          @foreach ($rekap_per_bulan as $item) 
                          <tr>
                              <td scope="row" class="text-center"><?php  $i++;  echo $i; ?></td>
                              <td scope="row">{{ $item->bulan }}</td>
                              <td scope="row" >Rp. {{ number_format($item->penjualan) }}</td>
                              <td scope="row" >Rp. {{ number_format($item->cash_in) }}</td>
                              <td scope="row" >Rp {{ number_format($item->piutang) }}</td>
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

    // grafik per sales
      var analytics_sales = <?php echo $tabel_sales; ?>;
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

      var data = new google.visualization.arrayToDataTable(analytics_sales);    
      var options = {
          chart: {
            title: ' ',      
          }
        };
      var chart = new google.charts.Bar(document.getElementById('chart_rekap_per_sales'));
      chart.draw(data, google.charts.Bar.convertOptions(options));

    }
</script>

<script type="text/javascript">
    // grafik per wilayah
    var analytics_wilayah = <?php echo $tabel_wilayah; ?>;
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

      var data = new google.visualization.arrayToDataTable(analytics_wilayah);    
      var options = {
          chart: {
            title: '',      
          }
        };
      var chart = new google.charts.Bar(document.getElementById('chart_rekap_per_wilayah'));
      chart.draw(data, google.charts.Bar.convertOptions(options));
    }
</script>
@endsection
