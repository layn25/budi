@extends('layouts.app')

@section('main-content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-2 text-gray-800">Peramalan Stok</h1>
        <div>
            <a href="#" data-toggle="modal" data-target="#peramalanModal" class="btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-plus fa-sm text-white-50"></i> Peramalan
            </a>
        </div>
        
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Hasil Peramalan</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama Barang</th>
                            {{-- <th>Periode</th>
                            <th>Hasil Ramalan</th> --}}
                            <th>MAPE</th>
                            <th>Tanggal Peramalan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($hasilPeramalan as $item)
                            <tr>
                                <td>{{ $item->barang->name ?? 'Barang tidak ditemukan' }}</td>
                                {{-- <td>{{ $item->periode }}</td>
                                <td>{{ $item->hasil_ramalan}}</td> --}}
                                <td>{{ round($item->mape, 2) }}%</td>
                                <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }}</td>
                                <td>
                                    <a href="{{ route('peramalan.hasil', $item->id) }}" class="btn btn-info btn-sm">
                                        Lihat Hasil
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Belum ada data peramalan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    @include('pages.peramalan.components.tambah')

@endsection