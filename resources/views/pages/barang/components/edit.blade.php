@foreach($barang as $item)
<!-- Modal Edit -->
<div class="modal fade" id="editBarang-{{ $item->id }}" tabindex="-1" aria-labelledby="editbarangLabel{{ $item->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('barang.update', $item->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel{{ $item->id }}">Edit Barang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Barang</label>
                        <input type="text" name="name" value="{{ $item->name }}" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" placeholder="Masukkan Deskripsi">{{ $item->deskripsi }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Kategori</label>
                        <select name="kategori" class="form-control" required>
                            <option value="" hidden>Pilih Kategori</option>
                            @php
                                $kategoriList = [
                                    'Kancing', 'Kain', 'Benang', 'Resleting', 'Jarum', 'Gunting',
                                    'Minyak Mesin', 'Penggaris', 'Karet', 'Tali', 'Label', 'Aksesoris', 'Lainnya'
                                ];
                            @endphp
                            @foreach($kategoriList as $kategori)
                                <option value="{{ $kategori }}" {{ $item->kategori == $kategori ? 'selected' : '' }}>
                                    {{ $kategori }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Harga</label>
                        <input type="number" name="harga" value="{{ $item->harga }}" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Jumlah</label>
                        <input type="number" name="jumlah" value="{{ $item->jumlah }}" class="form-control" required>
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
