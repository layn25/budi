@if(isset($item))
<!-- Modal Tambah Dokumentasi -->
<div class="modal fade" id="tambahDokumentasiModal-{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="tambahDokumentasiLabel-{{ $item->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{ route('dokumentasi.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="kegiatan_id" value="{{ $item->id }}">
            <input type="hidden" name="user_id" value="{{ Auth::id() }}">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Dokumentasi Kegiatan: {{ $item->nama_kegiatan }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama">Judul Dokumentasi</label>
                        <input type="text" name="nama" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="tipe">Tipe Dokumentasi</label>
                        <select name="tipe" class="form-control" required>
                            <option value="" hidden>Pilih Tipe</option>
                            <option value="foto">Foto</option>
                            <option value="video">Video</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="file_path">File Dokumentasi (jpg/png/mp4/pdf)</label>
                        <input type="file" name="file_path" class="form-control-file" required>
                    </div>

                    <div class="form-group">
                        <label for="deskripsi">Deskripsi (Opsional)</label>
                        <textarea name="deskripsi" class="form-control" rows="3"></textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endif
