<!-- Modal Tambah Stok Barang -->
@foreach($barangs as $barang)
<div class="modal fade" id="tambahStok-{{ $barang->id }}" tabindex="-1" role="dialog" aria-labelledby="tambahStokModalLabel-{{ $barang->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title m-0 font-weight-bold text-primary" id="tambahStokModalLabel">Tambah Stok - {{ $barang->name }}</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="{{ route('barang.tambah-stok', $barang->id) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="jumlah2">Jumlah</label>
                        <input type="number" class="form-control" id="jumlah" name="jumlah" min="1" placeholder="Masukkan Jumlah" required>
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
@endforeach