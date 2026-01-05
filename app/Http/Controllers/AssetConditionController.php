<?php

namespace App\Http\Controllers;

use App\Models\AssetCondition;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AssetConditionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $conditions = AssetCondition::orderBy('name')->get();

        $editData = null;
        if ($request->filled('edit')) {
            $editData = AssetCondition::findOrFail($request->edit);
        }

        return view('master.conditions.index', compact(
            'conditions',
            'editData'
        ));
    }

    /**
     * Simpan data baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:100',
            'description' => 'nullable|string',
            'is_active'   => 'required|boolean',
        ]);

        $code = $this->generateCodeFromName($request->name);

        AssetCondition::create([
            'code'        => $code,
            'name'        => $request->name,
            'description' => $request->description,
            'is_active'   => $request->is_active,
            'created_at'  => now(),
            'created_by'  => auth()->user()->id,
        ]);

        return redirect()
            ->route('master.conditions.index')
            ->with('success', 'Kondisi aset berhasil ditambahkan');
    }

    /**
     * Update data
     */
    public function update(Request $request, $id)
    {
        $condition = AssetCondition::findOrFail($id);

        $request->validate([
            'name'        => 'required|string|max:100',
            'description' => 'nullable|string',
            'is_active'   => 'required|boolean',
        ]);

        // regenerate code jika nama berubah
        $code = $condition->name !== $request->name
            ? $this->generateCodeFromName($request->name, $condition->id)
            : $condition->code;

        $condition->update([
            'code'        => $code,
            'name'        => $request->name,
            'description' => $request->description,
            'is_active'   => $request->is_active,
            'updated_at'  => now(),
            'updated_by'  => auth()->user()->id,
        ]);

        return redirect()
            ->route('master.conditions.index')
            ->with('success', 'Kondisi aset berhasil diperbarui');
    }

    /**
     * Generate kode otomatis dari nama
     * Contoh: "Rusak Berat" => RB
     */
    private function generateCodeFromName(string $name, $ignoreId = null): string
    {
        // Ambil huruf awal tiap kata
        $words = explode(' ', trim($name));
        $code = collect($words)
            ->map(fn ($word) => Str::upper(Str::substr($word, 0, 1)))
            ->implode('');

        // Batasi panjang
        $code = Str::limit($code, 5, '');

        // Cek unique
        $originalCode = $code;
        $counter = 1;

        while (
            AssetCondition::where('code', $code)
                ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $code = $originalCode . $counter;
            $counter++;
        }

        return $code;
    }
}