@foreach($kegiatan as $item)
<!-- Modal Detail -->
<div class="modal fade" id="detailKegiatan-{{ $item->id }}" tabindex="-1" aria-labelledby="detailKegiatanLabel{{ $item->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Kegiatan: {{ $item->nama_kegiatan }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Informasi Kegiatan -->
                <p><strong>Nama Kegiatan:</strong> {{ $item->nama_kegiatan }}</p>
                <p><strong>Tanggal Mulai:</strong> {{ $item->tanggal_mulai }}</p>
                <p><strong>Tanggal Selesai:</strong> {{ $item->tanggal_selesai }}</p>
                <p><strong>Deskripsi:</strong> {{ $item->deskripsi }}</p>

                <p><strong>Proposal:</strong> 
                    @if($item->proposal_file)
                        <a href="{{ asset('storage/' . $item->proposal_file) }}" target="_blank">Lihat Proposal</a>
                    @else
                        Tidak ada file
                    @endif
                </p>

                <p><strong>RAB:</strong> 
                    @if($item->rab_file)
                        <a href="{{ asset('storage/' . $item->rab_file) }}" target="_blank">Lihat RAB</a>
                    @else
                        Tidak ada file
                    @endif
                </p>

                <p><strong>LPJ:</strong> 
                    @if($item->lpj_file)
                        <a href="{{ asset('storage/' . $item->lpj_file) }}" target="_blank">Lihat LPJ</a>
                    @else
                        Tidak ada file
                    @endif
                </p>

                <hr>

                <!-- Tabel Dokumentasi -->
                <h5>Dokumentasi Kegiatan</h5>
                <div class="table-responsive">
                    <table class="table table-bordered datatable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Gambar</th>
                                <th>Deskripsi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @foreach($item->dokumentasi as $index => $dok)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    @if($dok->file_path)
                                        <img src="{{ asset('storage/' . $dok->file_path) }}" alt="Gambar" width="100">
                                    @else
                                        Tidak ada
                                    @endif
                                </td>
                                <td>{{ $dok->deskripsi }}</td>
                                <td>
                                    <form id="delete-{{ $dok->id }}" action="{{ route('dokumentasi.delete', $dok->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <div class="d-flex align-items-center gap-2">
                                            <button type="button" class="btn btn-danger btn-sm d-flex align-items-center ml-1" onclick="alertConfirm(this)" data-id="{{ $dok->id }}">
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
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endforeach
