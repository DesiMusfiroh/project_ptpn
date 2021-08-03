@extends('layouts.master')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Export Data Faktur Penjualan</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-md-5">
                <div class="card card-primary">
                    <div class="card-header">
                        <h4>Export Data Per Keyword</h4>
                    </div>
                    <form action="{{route('faktur.export.keyword')}}" method="POST" enctype="multipart/form-data">
                    @csrf 
                    <div class="card-body">
                        <div class="form-group row mb-0">
                            <label for="wilayah" class="col-sm-4 col-form-label">Pilih Keyword </label>
                            <div class="col-sm-8">
                                <select name="wilayah" class="form-control"  id="wilayah">
                                    <option value="">Pilih Bulan - Wilayah</option>
                                    @foreach ($keyword as $item)
                                    <option value="{{ $item->keyword }}">{{ $item->keyword }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button class="btn btn-primary mr-1 mt-0" type="submit">Export</button>
                    </div>
                    </form>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                  <div class="card-header">
                    <h4>Export Data </h4>
                  </div>
                  <div class="card-body">
                    <div class="jumbotron text-center pt-4 pb-4 mb-0">
                      <p>Export Data Faktur Keseluruhan</p>
                      <a href="{{route('faktur.export.all')}}"><button class="btn btn-primary">Export Semua Data</button></a> 
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
