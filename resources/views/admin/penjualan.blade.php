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
@endsection
