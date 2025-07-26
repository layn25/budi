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
                            <th>Deskripsi</th>
                            <th>Proposal</th>
                            <th>RAB</th>
                            <th>LPJ</th>
                            <th>Diinput Oleh</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nama Kegiatan</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Selesai</th>
                            <th>Deskripsi</th>
                            <th>Proposal</th>
                            <th>RAB</th>
                            <th>LPJ</th>
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
                                <td>{{ $item->deskripsi }}</td>
                                <td>
                                    @if($item->proposal_file)
                                        <a href="{{ asset('storage/' . $item->proposal_file) }}" target="_blank">Lihat</a>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    @if($item->rab_file)
                                        <a href="{{ asset('storage/' . $item->rab_file) }}" target="_blank">Lihat</a>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    @if($item->lpj_file)
                                        <a href="{{ asset('storage/' . $item->lpj_file) }}" target="_blank">Lihat</a>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>{{ $item->user->nama ?? 'Tidak diketahui' }}</td>
                                <td>
                                    <form id="delete-{{ $item->id }}" action="{{ route('kegiatan.delete', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <div class="d-flex align-items-center gap-2">
                                            <a href="#" class="btn btn-warning btn-sm d-flex align-items-center" data-toggle="modal" data-target="#editKegiatan-{{ $item->id }}">
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
@endsection
