<!-- Modal Peramalan -->
<div class="modal fade" id="peramalanModal" tabindex="-1" role="dialog" aria-labelledby="peramalanModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="{{ route('peramalan.hitung') }}" method="POST">
        @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="peramalanModalLabel">Proses Peramalan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="barang_id">Pilih Barang</label>
                    <select class="form-control" name="barang_id" required>
                        @foreach($barang as $b)
                            <option value="{{ $b->id }}">{{ $b->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="periode">Jumlah Periode (bulan)</label>
                    <input type="number" class="form-control" name="periode" min="1" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Proses</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </form>
  </div>
</div>
