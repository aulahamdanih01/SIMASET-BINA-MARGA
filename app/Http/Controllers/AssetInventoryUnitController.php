<?php

namespace App\Http\Controllers;

use App\Models\AssetInventoryUnit;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AssetInventoryUnitController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Index + Edit (dalam satu halaman)
     */
    public function index(Request $request)
    {
        $units = AssetInventoryUnit::orderBy('name')->get();

        $editData = null;
        if ($request->filled('edit')) {
            $editData = AssetInventoryUnit::findOrFail($request->edit);
        }

        return view('master.units.index', compact(
            'units',
            'editData'
        ));
    }

    /**
     * Simpan data baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:100',
            'symbol'    => 'required|string|max:20',
            'is_active' => 'required|boolean',
        ]);

        $code = $this->generateCodeFromName($request->symbol);

        AssetInventoryUnit::create([
            'code'       => $code,
            'name'       => $request->name,
            'symbol'     => $request->symbol,
            'is_active'  => $request->is_active,
            'created_at'=> now(),
            'created_by'=> auth()->user()->id,
        ]);

        return redirect()
            ->route('master.units.index')
            ->with('success', 'Satuan inventory berhasil ditambahkan');
    }

    /**
     * Update data
     */
    public function update(Request $request, $id)
    {
        $unit = AssetInventoryUnit::findOrFail($id);

        $request->validate([
            'name'      => 'required|string|max:100',
            'symbol'    => 'required|string|max:20',
            'is_active' => 'required|boolean',
        ]);

        // regenerate code jika simbol berubah
        $code = $unit->symbol !== $request->symbol
            ? $this->generateCodeFromName($request->symbol, $unit->id)
            : $unit->code;

        $unit->update([
            'code'       => $code,
            'name'       => $request->name,
            'symbol'     => $request->symbol,
            'is_active'  => $request->is_active,
            'updated_at'=> now(),
            'updated_by'=> auth()->user()->id,
        ]);

        return redirect()
            ->route('master.units.index')
            ->with('success', 'Satuan inventory berhasil diperbarui');
    }


        /**
     * Generate kode otomatis dari nama
     * Contoh: "Rusak Berat" => RB
     */
    private function generateCodeFromName(string $symbol, $ignoreId = null): string
    {
        $code = Str::upper($symbol);

        // Cek unique
        $originalCode = $code;
        $counter = 1;

        while (
            AssetInventoryUnit::where('code', $code)
                ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $code = $originalCode . $counter;
            $counter++;
        }

        return $code;
    }
}