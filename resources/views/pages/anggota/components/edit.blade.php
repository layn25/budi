<!-- Modal Edit Anggota -->
@foreach($anggota as $item)
    <div class="modal fade" id="editAnggota-{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="editAnggotaLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
        <form action="{{ route('anggota.update', $item->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Anggota</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body row">
                <div class="form-group col-md-6">
                <label>Nama</label>
                <input type="text" name="nama" class="form-control" value="{{ $item->nama }}" required>
                </div>
                <div class="form-group col-md-6">
                <label>Kontak</label>
                <input type="text" name="kontak" class="form-control" value="{{ $item->kontak }}" required>
                </div>
                <div class="form-group col-md-12">
                <label>Alamat</label>
                <textarea name="alamat" class="form-control" rows="3" required>{{ $item->alamat }}</textarea>
                </div>
                <div class="form-group col-md-6">
                <label>Foto (Opsional)</label><br>
                @if($item->foto)
                    <img src="{{ asset('storage/' . $item->foto) }}" alt="Foto" width="60" class="mb-2">
                @endif
                <input type="file" name="foto" class="form-control-file">
                </div>
                <div class="form-group col-md-6">
                <label>Status</label>
                <select name="status" class="form-control" required>
                    <option value="aktif" {{ $item->status === 'aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="tidak aktif" {{ $item->status === 'tidak aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Update</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            </div>
            </div>
        </form>
        </div>
    </div>
@endforeach
