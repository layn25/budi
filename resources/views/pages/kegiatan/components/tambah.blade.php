<!-- Modal Tambah Kegiatan -->
<div class="modal fade" id="tambahKegiatanModal" tabindex="-1" role="dialog" aria-labelledby="tambahKegiatanModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title m-0 font-weight-bold text-primary" id="tambahKegiatanModalLabel">Tambah Kegiatan</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="{{ route('kegiatan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_kegiatan">Nama Kegiatan</label>
                        <input type="text" class="form-control" id="nama_kegiatan" name="nama_kegiatan" placeholder="Masukkan nama kegiatan" required>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_mulai">Tanggal Mulai</label>
                        <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai" required>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_selesai">Tanggal Selesai</label>
                        <input type="date" class="form-control" id="tanggal_selesai" name="tanggal_selesai" required>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" placeholder="Masukkan deskripsi kegiatan"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="proposal_file">Upload Proposal</label>
                        <input type="file" class="form-control-file" id="proposal_file" name="proposal_file">
                    </div>
                    <div class="form-group">
                        <label for="rab_file">Upload RAB</label>
                        <input type="file" class="form-control-file" id="rab_file" name="rab_file">
                    </div>
                    <div class="form-group">
                        <label for="lpj_file">Upload LPJ</label>
                        <input type="file" class="form-control-file" id="lpj_file" name="lpj_file">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-info">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
