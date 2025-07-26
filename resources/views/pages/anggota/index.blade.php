@extends('layouts.app')

@section('main-content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-2 text-gray-800">Kelola Anggota</h1>
    <div>
        <a href="#" data-toggle="modal" data-target="#tambahAnggotaModal" class="btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Anggota
        </a>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Anggota</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Kontak</th>
                        <th>Alamat</th>
                        <th>Foto</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Nama</th>
                        <th>Kontak</th>
                        <th>Alamat</th>
                        <th>Foto</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach($anggota as $item)
                        <tr id="anggota-{{ $item->id }}">
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->kontak }}</td>
                            <td>{{ $item->alamat }}</td>
                            <td>
                                @if($item->foto)
                                    <img src="{{ asset('storage/' . $item->foto) }}" alt="Foto" width="60">
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                <span class="badge badge-{{ $item->status === 'aktif' ? 'success' : 'secondary' }}">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </td>
                            <td>
                                <form id="delete-{{ $item->id }}" action="{{ route('anggota.delete', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <div class="d-flex align-items-center gap-2">
                                        <a href="#" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editAnggota-{{ $item->id }}">
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

@include('pages.anggota.components.tambah')
@include('pages.anggota.components.edit')

@endsection
