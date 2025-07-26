@extends('layouts.app')

@section('main-content')
    
<!-- Begin Page Content -->

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-2 text-gray-800">Kelola keuangan</h1>
        <div>
            <a href="#" data-toggle="modal" data-target="#tambahKeuanganModal" class="btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah Keuangan</a>
        </div>
        
    </div>
    

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Keuangan</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Jenis Transaksi</th>
                            <th>Jumlah</th>
                            <th>Keterangan</th>
                            <th>Bukti File</th>
                            <th>Tanggal</th>
                            <th>Nama Kegiatan</th>
                            <th>Diinput Oleh</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Jenis Transaksi</th>
                            <th>Jumlah</th>
                            <th>Keterangan</th>
                            <th>Bukti File</th>
                            <th>Tanggal</th>
                            <th>Nama Kegiatan</th>
                            <th>Diinput Oleh</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($keuangan as $item)
                            <tr>
                                <td>{{ ucfirst($item->jenis_transaksi) }}</td>
                                <td>Rp{{ number_format($item->jumlah, 2, ',', '.') }}</td>
                                <td>{{ $item->keterangan ?? '-' }}</td>
                                <td>
                                    @if($item->bukti_file)
                                        <a href="{{ asset('storage/' . $item->bukti_file) }}" target="_blank">Lihat</a>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>{{ $item->tanggal }}</td>
                                <td>{{ $item->kegiatan->nama_kegiatan ?? 'Tidak diketahui' }}</td>
                                <td>{{ $item->user->nama ?? 'Tidak diketahui' }}</td>
                                <td>
                                    <form id="delete-{{ $item->id }}" action="{{ route('keuangan.delete', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <div class="d-flex align-items-center gap-2">
                                            <a href="#" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editKeuangan-{{ $item->id }}">
                                                <i class="fas fa-pen mr-1"></i> Edit
                                            </a>
                                            <button type="button" class="btn btn-danger btn-sm ml-1" onclick="alertConfirm(this)" data-id="{{ $item->id }}">
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
    @include('pages.keuangan.components.tambah')
    @include('pages.keuangan.components.edit')
@endsection
