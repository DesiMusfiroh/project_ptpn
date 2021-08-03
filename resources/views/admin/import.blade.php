@extends('layouts.master')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Import Data Faktur Penjualan</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-md-5">
                <div class="card card-primary">
                    <div class="card-header">
                        <h4>Import Data </h4>
                    </div>
                    <form action="{{route('faktur.import')}}" method="POST" enctype="multipart/form-data">
                    @csrf 
                    <div class="card-body">
                        <div class="form-group mb-0">
                            <label for="file">Pilih Data Excel (.csv)</label>
                            <input type="file" name="file"/>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button class="btn btn-primary mr-1 mt-0" type="submit">Submit</button>
                    </div>
                    </form>
                </div>
            </div>

            <div class="col-md-7">
                <div class="card">
                  <div class="card-header">
                    <h4>Ketentuan Import Data Faktur</h4>
                  </div>
                  <div class="card-body">
                    <div class="jumbotron text-center pt-4 pb-4">
                      <h6>Gambaran Tabel Excel Data Faktur</h6>
                      <img src="/images/Format Excel Faktur.jpg" alt="format excel" width="100%">
                    </div>
                    <ul>
                        <li>Data yang di import harus berupa file <b> excel dengan format .csv </b></li>
                        <li>Penamaan header kolom pada excel harus seperti yang tertera pada gambar diatas, yaitu dengan urutan : <b> no_faktur, tanggal_faktur, kode_sales, kode_wilayah, nama_sales, wilayah, nama_outlet, penjualan, cash_in, piutang </b></li>
                        <li>Agar lebih terstrukur, Keyword data excel yang dimasukkan sebaiknya mengikuti contoh berikut : <b> [bulan]/[tahun] [wilayah] </b>.</li>
                        <li>Pastikan data di kolom tanggal_faktur menggunakan format <b>"date"</b>.</li>
                    </ul>
                  </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
