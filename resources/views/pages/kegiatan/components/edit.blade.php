@foreach($kegiatan as $item)
<!-- Modal Edit -->
<div class="modal fade" id="editKegiatan-{{ $item->id }}" tabindex="-1" aria-labelledby="editKegiatanLabel{{ $item->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('kegiatan.update', $item->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel{{ $item->id }}">Edit Kegiatan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Kegiatan</label>
                        <input type="text" name="nama_kegiatan" value="{{ $item->nama_kegiatan }}" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Mulai</label>
                        <input type="date" name="tanggal_mulai" value="{{ $item->tanggal_mulai }}" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Selesai</label>
                        <input type="date" name="tanggal_selesai" value="{{ $item->tanggal_selesai }}" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" placeholder="Masukkan Deskripsi">{{ $item->deskripsi }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Proposal (PDF/DOC, max 2MB)</label><br>
                        @if($item->proposal_file)
                            <small>File saat ini: <a href="{{ asset('storage/' . $item->proposal_file) }}" target="_blank">Lihat</a></small><br>
                        @endif
                        <input type="file" name="proposal_file" class="form-control-file">
                    </div>
                    <div class="form-group">
                        <label>RAB (PDF/DOC, max 2MB)</label><br>
                        @if($item->rab_file)
                            <small>File saat ini: <a href="{{ asset('storage/' . $item->rab_file) }}" target="_blank">Lihat</a></small><br>
                        @endif
                        <input type="file" name="rab_file" class="form-control-file">
                    </div>
                    <div class="form-group">
                        <label>LPJ (PDF/DOC, max 2MB)</label><br>
                        @if($item->lpj_file)
                            <small>File saat ini: <a href="{{ asset('storage/' . $item->lpj_file) }}" target="_blank">Lihat</a></small><br>
                        @endif
                        <input type="file" name="lpj_file" class="form-control-file">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endforeach
