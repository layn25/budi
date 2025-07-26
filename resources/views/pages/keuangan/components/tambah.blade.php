<!-- Modal Tambah Keuangan -->
<div class="modal fade" id="tambahKeuanganModal" tabindex="-1" aria-labelledby="tambahKeuanganLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('keuangan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahKeuanganLabel">Tambah Data Keuangan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Pilih Kegiatan</label>
                        @if($kegiatan->count() > 0)
                            <select name="kegiatan_id" class="form-control" required>
                                <option value="" hidden>Pilih Kegiatan</option>
                                @foreach($kegiatan as $kegiatans)
                                    <option value="{{ $kegiatans->id }}">{{ $kegiatans->nama_kegiatan }}</option>
                                @endforeach
                            </select>
                        @else
                            <div class="alert alert-warning mb-0">
                                Belum ada kegiatan. Silakan tambahkan kegiatan terlebih dahulu.
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Jenis Transaksi</label>
                        <select name="jenis_transaksi" class="form-control" required>
                            <option value="" hidden>Pilih Jenis</option>
                            <option value="pemasukan">Pemasukan</option>
                            <option value="pengeluaran">Pengeluaran</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Jumlah</label>
                        <input type="number" step="0.01" name="jumlah" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Tanggal</label>
                        <input type="date" name="tanggal" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea name="keterangan" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Bukti File (opsional)</label>
                        <input type="file" name="bukti_file" class="form-control-file" accept=".pdf,.jpg,.jpeg,.png,.doc,.docx">
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
