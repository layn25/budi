<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Throwable;

class PenggunaController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('pages.pengguna.index', compact('users'));
    }
    public function create(Request $request)
    {
        try {
            $validated = $request->validate([
                'nama'=> 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password'=> 'required|string|min:8|max:12|confirmed',
                'role'=> 'required|in:admin,operator',
                'status'=> 'nullable|in:aktif,nonaktif',
            ]);

            $user = new User();
            $user->nama     = $validated['nama'];
            $user->email    = $validated['email'];
            $user->password = $validated['password'];
            $user->role     = $validated['role'];
            $user->status   = $validated['status'] ?? 'aktif'; 

            $user->save();

            return redirect()->back()->with('success', 'User berhasil ditambahkan!');
        } catch (Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
    public function update(Request $request, $id)
{
    try {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'nama'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'role'  => 'required|in:admin,operator',
            'status' => 'required|in:aktif,nonaktif',
            'password' => 'nullable|string|min:8|max:12|confirmed',
        ]);

        $user->nama = $validated['nama'];
        $user->email = $validated['email'];
        $user->role = $validated['role'];
        $user->status = $validated['status'];

        // Update password jika ada input baru
        if (!empty($validated['password'])) {
            $user->password = $validated['password'];
        }

        $user->save();

        return redirect()->back()->with('success', 'User berhasil diperbarui!');
    } catch (Throwable $th) {
        return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $th->getMessage());
    }
}
    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('success', 'User berhasil dihapus!');
    }
}
