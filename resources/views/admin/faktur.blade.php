@extends('layouts.master')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Data Faktur Penjualan</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h4>Pencarian Data Faktur</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form action="{{route('faktur')}}" method="GET">
                                    <div class="form-group">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name="cari" placeholder="Masukkan kata kunci pencarian .." aria-label="" value="{{ old('cari') }}" >
                                        <div class="input-group-append">
                                        <button class="btn btn-success" type="submit"> <i class= "fa fa-search" aria-hidden= "true" ></i></button>
                                        </div>
                                    </div>
                                    </div>
                                </form>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>

            <div class="col-md-2 col-12">
                <div class="card">
                    <div class="card-header justify-content-center">
                        <h4 class="text-center">Jumlah Data Faktur</h4>
                    </div>
                    <div class="card-body bg-secondary">
                        <h2 class="text-center">{{ $count }}</h2>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-12">
                <div class="card">
                    <div class="card-header justify-content-center">
                        <h4 class="text-center">Hapus Multiple Faktur</h4>
                    </div>
                    <div class="card-body text-center">
                       <button class="btn btn-danger btn-action"  data-toggle="modal" data-target=".delete_by_keyword_modal">Hapus Faktur Berdasarkan Keyword</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>List Faktur Penjualan</h4>
                        <div class="card-header-action">
                            <div class="dropdown mr-2">
                                <a href="#" class="dropdown-toggle btn btn-primary" data-toggle="dropdown">Filter Sales</a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    @foreach ($sales as $item)
                                    <a href="{{route('faktur',['cari_sales'=> $item->id])}}"  class="dropdown-item has-icon">{{$item->nama}} </a>
                                    @endforeach
                                    <div class="dropdown-divider"></div>
                                    <a href="{{route('faktur')}}" class="dropdown-item">Lihat semua</a>
                                </div>
                            </div>
                            <div class="dropdown">
                                <a href="#" class="dropdown-toggle btn btn-primary" data-toggle="dropdown">Filter Wilayah</a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    @foreach ($wilayah as $item)
                                    <a href="{{route('faktur',['cari_wilayah'=> $item->id])}}"  class="dropdown-item has-icon">{{$item->nama}} </a>
                                    @endforeach
                                    <div class="dropdown-divider"></div>
                                    <a href="{{route('faktur')}}" class="dropdown-item">Lihat semua</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
            
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
                                <th scope="col" class="text-center" width="180px">Aksi</th>
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
                                    <td class="text-center">
                                        <button type="button" class="btn btn-warning btn-sm btn-action mr-1 mb-1" data-toggle="modal" data-target=".update_modal"
                                            id="update"                                   
                                            data-id="{{ $item->id }}"    
                                            data-no_faktur_update="{{ $item->no_faktur }}"
                                            data-tanggal_faktur_update="{{ $date }}"     
                                            data-sales_update="{{ $item->sales_id }}"
                                            data-nama_sales_update="{{ $item->sales->nama }}"
                                            data-wilayah_update="{{ $item->wilayah_id }}"
                                            data-nama_wilayah_update="{{ $item->wilayah->nama }}"
                                            data-nama_outlet_update="{{ $item->nama_outlet }}"
                                            data-penjualan_update="{{ $item->penjualan }}"
                                            data-cash_in_update="{{ $item->cash_in }}"
                                            data-piutang_update="{{ $item->piutang }}" >  
                                            <i class="fa fa-edit"></i>             
                                        </button>
                                    
                                        <button class="btn btn-danger btn-sm btn-action mr-1 mb-1" data-toggle="modal" data-target=".delete_modal"
                                            id="delete"
                                            data-id_delete="{{ $item->id }}"
                                            data-no_faktur_delete="{{ $item->no_faktur }}">
                                            <i class="fa fa-trash"></i>                                       
                                        </button>
                                    </td>  
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

        <div class="row">
            <div class="col-md-12">
                {{$faktur->links('vendor.pagination.pagination')}}
            </div>
        </div>
    </div>
</section>

<!-- Update  modal -->
<div class="modal fade update_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> Update Data Faktur </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('faktur.update')}}" method="post" enctype="multipart/form-data" >
            <div class="modal-body">
                @csrf
                @method('PATCH')
                    <div class="container">
                     
                        <input type="hidden" name="id" id="id" value="">  
                        <div class="form-group row">
                            <label for="no_faktur" class="col-sm-4 col-form-label">Nomor Faktur</label>
                            <div class="col-sm-8">
                            <input type="text" class="form-control"  name="no_faktur" id="no_faktur_update" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tanggal_faktur" class="col-sm-4 col-form-label">Tanggal Faktur</label>
                            <div class="col-sm-8">
                            <input type="text" class="form-control"  name="tanggal_faktur" id="tanggal_faktur_update" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="sales" class="col-sm-4 col-form-label">Sales</label>
                            <div class="col-sm-8">
                                <select name="sales_id" class="form-control" id="sales_id">
                                    <option id="sales_update" value="" selected> Pilih Sales <span class="nama_sales_update"></span> </option>
                                    @foreach ($sales as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="wilayah" class="col-sm-4 col-form-label">Wilayah</label>
                            <div class="col-sm-8">
                                <select name="wilayah_id" class="form-control"  id="wilayah_id">
                                    <option id="wilayah_update" value="" selected> Pilih Wilayah <span class="nama_wilayah_update" value=""></span></option>
                                    @foreach ($wilayah as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nama_outlet" class="col-sm-4 col-form-label">Nama Outlet</label>
                            <div class="col-sm-8">
                            <input type="text" class="form-control" name="nama_outlet" id="nama_outlet_update" value="" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="penjualan" class="col-sm-4 col-form-label">Penjualan</label>
                            <div class="col-sm-8">
                            <input type="text" class="form-control" name="penjualan" id="penjualan_update" value="" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="cash_in" class="col-sm-4 col-form-label">Cash In</label>
                            <div class="col-sm-8">
                            <input type="text" class="form-control" name="cash_in" id="cash_in_update" value="" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="piutang" class="col-sm-4 col-form-label">Piutang</label>
                            <div class="col-sm-8">
                            <input type="text" class="form-control" name="piutang" id="piutang_update" value="" >
                            </div>
                        </div>
                    </div>                               
            </div>
            <div class="modal-footer">   
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-warning">Update</button>                               
            </div>
            </form>
        </div>
    </div>
</div>
<!-- Penutup Update  modal -->

<!-- Delete Modal -->
<div class="modal fade delete_modal"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" >
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title " id="exampleModalLabel">Hapus Faktur</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="{{route('faktur.delete')}}" method="post">
            @csrf
            <div class="modal-body">
                <input type="hidden" name="id" value="" id="id_delete" >
                <p>Data Faktur Nomor<b> <span id="no_faktur_delete"></span> </b> akan di hapus </p>     
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger">Hapus Faktur</button>
            </div>
        </form>
        </div>
    </div>
    </div>
<!-- Penutup Delete Modal -->

<!-- Delete Multiple Modal -->
<div class="modal fade delete_by_keyword_modal"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" >
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title " id="exampleModalLabel">Hapus Faktur Berdasarkan Keyword</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="{{route('faktur.delete.keywords')}}" method="post">
            @csrf
            <div class="modal-body">
                <p>Silahkan pilih keyword data faktur yang akan dihapus ! </p> 
                @foreach ($keyword as $item)
                <div class="form-check">
                    <input class="form-check-input"  type="checkbox" name="delete_keywords[]" value="{{$item}}">
                    <label class="form-check-label" for="{{$item}}">
                        {{$item}}
                    </label>
                </div>
                @endforeach
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger">Hapus Faktur</button>
            </div>
        </form>
        </div>
    </div>
    </div>
<!-- Penutup Delete Multiple Modal -->

<script>
$(document).ready(function(){
    $(document).on('click','#update', function(){
        var id                    = $(this).data('id');
        var no_faktur_update      = $(this).data('no_faktur_update');  
        var tanggal_faktur_update = $(this).data('tanggal_faktur_update');  
        var sales_update          = $(this).data('sales_update');
        var nama_sales_update     = $(this).data('nama_sales_update');
        var wilayah_update        = $(this).data('wilayah_update');
        var nama_wilayah_update   = $(this).data('nama_wilayah_update');
        var nama_outlet_update    = $(this).data('nama_outlet_update');
        var penjualan_update      = $(this).data('penjualan_update');
        var cash_in_update        = $(this).data('cash_in_update');
        var piutang_update        = $(this).data('piutang_update');

        $('#id').val(id);                
        $('#no_faktur_update').val(no_faktur_update);  
        $('#tanggal_faktur_update').val(tanggal_faktur_update);  
        $('#sales_update').val(sales_update);  
        $('.nama_sales_update').text(nama_sales_update);  
        $('#wilayah_update').val(wilayah_update);  
        $('.nama_wilayah_update').text(nama_wilayah_update);  
        $('#nama_outlet_update').val(nama_outlet_update);  
        $('#penjualan_update').val(penjualan_update);  
        $('#cash_in_update').val(cash_in_update);  
        $('#piutang_update').val(piutang_update);  
    });

    $(document).on('click','#delete', function(){
        var id_delete   = $(this).data('id_delete');  
        var no_faktur_delete = $(this).data('no_faktur_delete');   
        $('#id_delete').val(id_delete);
        $('#no_faktur_delete').text(no_faktur_delete);
    });     
});
</script>

@endsection
