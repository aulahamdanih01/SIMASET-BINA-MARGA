<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Tampilkan daftar PIC + form tambah
     */
    public function index()
    {
        $users = User::orderBy('name')->get();

        return view('master.pic.index', compact('users'));
    }

    /**
     * Simpan user baru (PIC / Admin)
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'nip'      => 'nullable|string|max:50',
            'position' => 'nullable|string|max:100',
            'address'  => 'nullable|string',
            'phone'    => 'nullable|string|max:20',
            'email'    => 'required|email|unique:users,email',
            'role'     => 'required|in:admin,operator',
            'password' => 'required|string|min:6',
        ]);

        // 🔐 Hanya admin boleh membuat admin
        if ($validated['role'] === 'admin' && Auth::user()->role !== 'admin') {
            return back()->withErrors([
                'role' => 'Anda tidak memiliki hak untuk membuat Admin'
            ]);
        }

        $validated['password'] = Hash::make($validated['password']);
        $validated['last_active'] = now();

        User::create($validated);

        return redirect()
            ->back()
            ->with('success', 'User berhasil ditambahkan');
    }

    /**
     * Detail & Edit (gabungan)
     * mode=edit → edit
     */
    public function show(Request $request, User $user)
    {
        $isEdit = $request->query('mode') === 'edit';

        // 🔐 Proteksi edit hanya admin
        if ($isEdit && Auth::user()->role !== 'admin') {
            abort(403);
        }

        return view('master.pic.show', compact('user', 'isEdit'));
    }

    /**
     * Update data user
     */
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'nip'      => 'nullable|string|max:50',
            'position' => 'nullable|string|max:100',
            'address'  => 'nullable|string',
            'phone'    => 'nullable|string|max:20',
            'email'    => 'required|email|unique:users,email,' . $user->id,
            'role'     => 'nullable|in:admin,operator',
            'password' => 'nullable|min:6',
        ]);

        // 🔐 Proteksi role
        if (isset($data['role']) && Auth::user()->role !== 'admin') {
            unset($data['role']);
        }

        // 🔐 Password opsional
        if (empty($data['password'])) {
            unset($data['password']);
        } else {
            $data['password'] = Hash::make($data['password']);
        }

        $user->update($data);

        return redirect()
            ->route('master.pic.show', $user->id)
            ->with('success', 'Data PIC berhasil diperbarui');
    }
}
