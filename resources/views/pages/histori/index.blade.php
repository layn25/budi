@extends('layouts.app')

@section('main-content')
    
<!-- Begin Page Content -->

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-2 text-gray-800">Historis Stok</h1>
        
        {{-- <div>
            <a href="#" data-toggle="modal" data-target="#inputModal" class="btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah Barang</a>
        </div> --}}
        
    </div>
    

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Histori Stok</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama Barang</th>
                            <th>Bulan</th>
                            <th>Stok terjual</th>
                            <th>Tanggal Dibuat</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nama Barang</th>
                            <th>Bulan</th>
                            <th>Stok terjual</th>
                            <th>Tanggal Dibuat</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($histori as $item)
                            <tr>
                                <td>{{ $item->barang->name }}</td>
                                <td>{{ $item->bulan }}</td>
                                <td>{{ $item->stok_terjual }}</td>
                                <td>{{ $item->created_at->format('d/m/Y') }}</td>
                                
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{-- @include('pages.barang.components.edit') --}}
@endsection
