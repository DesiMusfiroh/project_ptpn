@extends('layouts.welcome')

@section('content')

<section class="section">
    <div class="section-header">
        <h1>Piutang Penjualan SBUPTK</h1>
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
                    Rp. {{ number_format($total_penjualan)}}
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
        <div class="col-md-12 col-sm-12 col-lg-12">
            <div class="card justify-content-center">
                <div class="card-header"> 
                    <h4>Grafik Rekapitulasi Per Bulan</h4>
                </div>
                <div class="card-body mr-3 ml-3">
                    <div id="chart_rekap_per_bulan" style="height: 200px;"></div>
                </div>
                
            </div>    
        </div>

    </div>
</section>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">

    var analytics_bulan = <?php echo $tabel_bulan; ?>;
    google.charts.load('current', {'packages':['line']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

    var data = new google.visualization.arrayToDataTable(analytics_bulan);    
    var options = {
        chart: {
            title: ' ',      
        }
    };
    var chart = new google.charts.Line(document.getElementById('chart_rekap_per_bulan'));
    chart.draw(data, google.charts.Line.convertOptions(options));

    }
</script>

@endsection