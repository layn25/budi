@foreach($users as $user)
<!-- Modal Edit Pengguna -->
<div class="modal fade" id="editPengguna-{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="editPenggunaLabel{{ $user->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title m-0 font-weight-bold text-primary" id="editPenggunaLabel{{ $user->id }}">Edit Pengguna</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="{{ route('pengguna.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama{{ $user->id }}">Nama</label>
                        <input type="text" class="form-control" id="nama{{ $user->id }}" name="nama" value="{{ $user->nama }}" required>
                    </div>
                    <div class="form-group">
                        <label for="email{{ $user->id }}">Email</label>
                        <input type="email" class="form-control" id="email{{ $user->id }}" name="email" value="{{ $user->email }}" required>
                    </div>
                    <div class="form-group">
                        <label for="password{{ $user->id }}">Password <small>(kosongkan jika tidak diubah)</small></label>
                        <input type="password" class="form-control" id="password{{ $user->id }}" name="password" placeholder="Masukkan Password Baru">
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation{{ $user->id }}">Konfirmasi Password</label>
                        <input type="password" class="form-control" id="password_confirmation{{ $user->id }}" name="password_confirmation" placeholder="Konfirmasi Password Baru">
                    </div>
                    <div class="form-group">
                        <label for="role{{ $user->id }}">Role</label>
                        <select class="form-control" id="role{{ $user->id }}" name="role" required>
                            <option value="operator" {{ $user->role == 'operator' ? 'selected' : '' }}>Pengguna</option>
                            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="status{{ $user->id }}">Status</label>
                        <select class="form-control" id="status{{ $user->id }}" name="status" required>
                            <option value="aktif" {{ $user->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="nonaktif" {{ $user->status == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
