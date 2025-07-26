<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Throwable;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('pages.profile.index');
    }

    public function update(Request $request)
    {
        try {
            $request->validate([
                'nama' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email,' . Auth::user()->id,
                'current_password' => 'nullable|required_with:new_password',
                'new_password' => 'nullable|min:8|max:12|required_with:current_password',
                'password_confirmation' => 'nullable|min:8|max:12|required_with:new_password|same:new_password'
            ]);

            $user = User::findOrFail(Auth::user()->id);
            $user->nama = $request->input('nama');
            $user->email = $request->input('email');

            // Ubah password hanya jika user isi new_password
            if ($request->filled('new_password')) {
                if ($request->filled('current_password') && Hash::check($request->input('current_password'), $user->password)) {
                    $user->password = $request->input('new_password');
                } else {
                    return redirect()->back()->with('error', 'Password lama tidak sesuai!');
                }
            }
            $user->save();
            return redirect()->back()->with('success', 'User berhasil disimpan!');
        } catch (Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
        
    }

}
