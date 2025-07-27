@extends('layouts.app')

@section('main-content')
    
<!-- Begin Page Content -->

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-2 text-gray-800">Kelola kegiatan</h1>
        <div>
            <a href="#" data-toggle="modal" data-target="#tambahKegiatanModal" class="btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah kegiatan</a>
        </div>
        
    </div>
    

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Kegiatan</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama Kegiatan</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Selesai</th>
                            <th>Diinput Oleh</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nama Kegiatan</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Selesai</th>
                            <th>Diinput Oleh</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($kegiatan as $item)
                            <tr id="kegiatan-{{ $item->id }}">
                                <td>{{ $item->nama_kegiatan }}</td>
                                <td>{{ $item->tanggal_mulai }}</td>
                                <td>{{ $item->tanggal_selesai }}</td>
                                <td>{{ $item->user->nama ?? 'Tidak diketahui' }}</td>
                                <td>
                                    <form id="delete-{{ $item->id }}" action="{{ route('kegiatan.delete', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <div class="d-flex align-items-center gap-2">
                                            <a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#tambahDokumentasiModal-{{ $item->id }}">
                                                <i class="fas fa-plus"></i> Tambah Dokumentasi
                                            </a>
                                            <a href="#" class="btn btn-info btn-sm d-flex align-items-center ml-1" data-toggle="modal" data-target="#detailKegiatan-{{ $item->id }}">
                                                <i class="fas fa-info-circle mr-1"></i> Detail
                                            </a>
                                            <a href="#" class="btn btn-warning btn-sm d-flex align-items-center ml-1" data-toggle="modal" data-target="#editKegiatan-{{ $item->id }}">
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
    @include('pages.kegiatan.components.tambah')
    @include('pages.kegiatan.components.edit')
    @include('pages.kegiatan.components.detail')
    @include('pages.kegiatan.components.tambahDokumentasi')
@endsection
