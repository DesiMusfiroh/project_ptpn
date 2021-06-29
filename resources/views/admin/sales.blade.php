<?php use App\Sales; ?>
@extends('layouts.master')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Data Sales</h1>
    </div>

    <div class="section-body">

        <div class="row">
            <div class="col-12 col-md-8 col-lg-8">
                <div class="card">
                    <div class="card-header mb-0">
                        <h4>List Sales</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-inside">
                            <table class="table table-striped table-md">
                                <thead>
                                    <tr>
                                    <th scope="col" class="text-center">No</th>
                                    <th scope="col" class="text-center">Nama</th>
                                    <th scope="col" class="text-center">Wilayah</th>
                                    <th scope="col" class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=0; ?>                                                 
                                    @foreach ($sales as $item) 
                                    <tr>
                                        <td scope="row" class="text-center"><?php  $i++;  echo $i; ?></td>
                                        <td scope="row">{{ $item->nama }}</td>
                                        <td scope="row" >{{ $item->wilayah }}</td>
                                                                
                                        <td scope="row" class="text-center">
                                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target=".update_modal"
                                                id="update"                                   
                                                data-id="{{ $item->id }}"    
                                                data-nama_update="{{ $item->nama }}"     
                                                data-wilayah_update="{{ $item->wilayah }}">  
                                                <i class="fa fa-edit"></i>             
                                            </button>
                                        
                                            <button class="btn btn-danger" data-toggle="modal" data-target=".delete_modal"
                                                id="delete"
                                                data-id_delete="{{ $item->id }}"
                                                data-nama_delete="{{ $item->nama }}">
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

            <div class="col-12 col-md-4 col-lg-4">
                <div class="card">
                    <div class="card-header mb-0">
                        <h4>Tambah Data Sales</h4>
                    </div>
                    <div class="card-body">
                        <a> <button type="button" class="btn" style="background-color:#c4eb2a;" data-toggle="modal" data-target=".create_modal" id="create">
                            Tambah Sales</button> 
                        </a> 
                    </div>
                </div>

                <div class="card">
                    <div class="card-header mb-0">
                        <h4>Import Data Sales dari Excel (.csv)</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{route('sales.import')}}" method="POST" enctype="multipart/form-data">
                            @csrf 
                            <input type="file" name="file" class="form-control mb-4"/>
                            <button type="submit" class="btn btn-primary">Import Data </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

    



<!-- Create Modal -->
<div class="modal fade create_modal"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header ">
                <h5 class="modal-title " id="exampleModalLabel">Tambah Sales</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/admin/sales/store" enctype="multipart/form-data" method="post">
                @csrf
                <div class="modal-body">
                    <div class="container">  
                        <div class="form-group row">
                            <label for="nama" class="col-sm-4 col-form-label">Nama Sales </label>
                            <div class="col-sm-8">
                            <input type="text" class="form-control" id="nama" name="nama" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="wilayah" class="col-sm-4 col-form-label">Wilayah</label>
                            <div class="col-sm-8">
                            <input type="text" class="form-control" id="wilayah" name="wilayah" >
                            </div>
                        </div>
                      
                    </div>    
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-info">Simpan</button>
                </div>
            </form>
        </div>
    </div>
    </div>
<!-- Penutup Create Modal -->

            
<!-- Update  modal -->
<div class="modal fade update_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> Update Data Sales </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/admin/sales/update" method="post">
            <div class="modal-body">
                @csrf
                @method('PATCH')
                    <div class="container">
                     
                        <input type="hidden" name="id" id="id" value="">  
                       
                        <div class="form-group row">
                            <label for="nama" class="col-sm-4 col-form-label">Nama Sales</label>
                            <div class="col-sm-8">
                            <input type="text" class="form-control"  name="nama" id="nama_update" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="wilayah" class="col-sm-4 col-form-label">Wilayah </label>
                            <div class="col-sm-8">
                            <input type="text" class="form-control" name="wilayah" id="wilayah_update" >
                            </div>
                        </div>
                    </div>                               

            </div>
            <div class="modal-footer">   
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
            <h5 class="modal-title " id="exampleModalLabel">Hapus Sales</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="/admin/sales/delete" method="post">
            @csrf
            <div class="modal-body">
                <input type="hidden" name="id" value="" id="id_delete" >
                <p>Data sales <b> <span id="nama_delete"></span>  </b> akan di hapus </p>     
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger">Hapus Sales</button>
            </div>
        </form>
        </div>
    </div>
    </div>
<!-- Penutup Delete Modal -->

<script>
$(document).ready(function(){
    $(document).on('click','#update', function(){
        var id                  = $(this).data('id');
        var nama_update         = $(this).data('nama_update');  
        var wilayah_update      = $(this).data('wilayah_update');
        $('#id').val(id);                
        $('#nama_update').val(nama_update);  
        $('#wilayah_update').val(wilayah_update);  
    });

    $(document).on('click','#delete', function(){
        var id_delete   = $(this).data('id_delete');    
        var nama_delete = $(this).data('nama_delete');   
        $('#id_delete').val(id_delete);
        $('#nama_delete').text(nama_delete);
    });     
});
</script>

@endsection

</body>
</html>