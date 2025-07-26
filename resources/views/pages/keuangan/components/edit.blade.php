@foreach($keuangan as $item)
<div class="modal fade" id="editKeuangan-{{ $item->id }}" tabindex="-1" aria-labelledby="editKeuanganLabel{{ $item->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('keuangan.update', $item->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editKeuanganLabel{{ $item->id }}">Edit Data Keuangan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Jenis Transaksi</label>
                        <select name="jenis_transaksi" class="form-control" required>
                            <option value="pemasukan" {{ $item->jenis_transaksi == 'pemasukan' ? 'selected' : '' }}>Pemasukan</option>
                            <option value="pengeluaran" {{ $item->jenis_transaksi == 'pengeluaran' ? 'selected' : '' }}>Pengeluaran</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Jumlah</label>
                        <input type="number" step="0.01" name="jumlah" value="{{ $item->jumlah }}" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Tanggal</label>
                        <input type="date" name="tanggal" value="{{ $item->tanggal }}" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea name="keterangan" class="form-control">{{ $item->keterangan }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Ganti Bukti File (kosongkan jika tidak diganti)</label>
                        <input type="file" name="bukti_file" class="form-control-file" accept=".pdf,.jpg,.jpeg,.png,.doc,.docx">
                        @if($item->bukti_file)
                            <p class="mt-2">File Saat Ini: <a href="{{ asset('storage/' . $item->bukti_file) }}" target="_blank">Lihat</a></p>
                        @endif
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
