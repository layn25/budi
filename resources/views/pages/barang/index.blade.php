@extends('layouts.app')

@section('main-content')
    
<!-- Begin Page Content -->

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-2 text-gray-800">Kelola Barang</h1>
        <div>
            <a href="#" data-toggle="modal" data-target="#inputModal" class="btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah Barang</a>
        </div>
        
    </div>
    

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Barang</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama Barang</th>
                            <th>Deskripsi</th>
                            <th>Kategori</th>
                            <th>Jumlah</th>
                            <th>Harga</th>
                            <th>Updated at</th>
                            <th>Diupdate Oleh</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nama Barang</th>
                            <th>Deskripsi</th>
                            <th>Kategori</th>
                            <th>Jumlah</th>
                            <th>Harga</th>
                            <th>Updated_at</th>
                            <th>Diupdate Oleh</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($barang as $item)
                            <tr id="barang-{{ $item->id }}">
                                <td>{{ $item->name }}</td>
                                <td class="deskripsi-col">{{ $item->deskripsi }}</td>
                                <td>{{ $item->kategori }}</td>
                                <td>{{ $item->jumlah }}</td>
                                <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                                <td>{{ $item->updated_at->format('d/m/Y') }}</td>
                                <td>{{ $item->user->nama }}</td>
                                <td>
                                    <form id="delete-{{ $item->id }}" action="{{ route('barang.delete', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <div class="d-flex align-items-center gap-2">
                                            <a href="#" class="btn btn-warning btn-sm d-flex align-items-center" data-toggle="modal" data-target="#editBarang-{{ $item->id }}">
                                                <i class="fas fa-pen mr-1"></i> Edit
                                            </a>

                                            <button type="button" class="btn btn-danger btn-sm d-flex align-items-center ml-1" onclick="alertConfirm(this)" data-id="{{ $item->id }}">
                                                <i class="fas fa-trash mr-1"></i> Hapus
                                            </button>
                                        </div>
                                    </form>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('pages.barang.components.edit')
@endsection
