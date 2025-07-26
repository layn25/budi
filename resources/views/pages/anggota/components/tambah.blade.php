<!-- Modal Tambah Anggota -->
<div class="modal fade" id="tambahAnggotaModal" tabindex="-1" role="dialog" aria-labelledby="tambahAnggotaLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="{{ route('anggota.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">Tambah Anggota</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body row">
            <div class="form-group col-md-6">
                <label>Nama</label>
                <input type="text" name="nama" class="form-control" required>
            </div>
            <div class="form-group col-md-6">
                <label>Kontak</label>
                <input type="text" name="kontak" class="form-control" required>
            </div>
            <div class="form-group col-md-12">
                <label>Alamat</label>
                <textarea name="alamat" class="form-control" rows="3" required></textarea>
            </div>
            <div class="form-group col-md-6">
                <label>Foto</label>
                <input type="file" name="foto" class="form-control-file">
            </div>
            <div class="form-group col-md-6">
                <label>Status</label>
                <select name="status" class="form-control" required>
                <option value="" hidden>Pilih Status</option>
                <option value="aktif">Aktif</option>
                <option value="tidak aktif">Tidak Aktif</option>
                </select>
            </div>
            </div>
            <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            </div>
        </div>
        </form>
    </div>
</div>
