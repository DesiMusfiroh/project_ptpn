@extends('layouts.master')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Import Data Penjualan</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Import Data </h4>
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
    </div>
</section>
@endsection
