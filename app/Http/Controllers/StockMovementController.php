<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\StockMovement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class StockMovementController extends Controller
{
    public function index()
    {
        $movements = StockMovement::with(['item', 'user'])
            ->latest()
            ->paginate(15);

        return view('movements.index', compact('movements'));
    }

    public function create()
    {
        $items = Item::orderBy('name')->get();

        return view('movements.create', compact('items'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'item_id' => ['required', 'exists:items,id'],
            'type' => ['required', Rule::in(['in', 'out'])],
            'quantity' => ['required', 'integer', 'min:1'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);

        DB::transaction(function () use ($data, $request) {
            $item = Item::whereKey($data['item_id'])
                ->lockForUpdate()
                ->firstOrFail();

            if (
                $data['type'] === 'out' &&
                $item->stock < $data['quantity']
            ) {
                throw ValidationException::withMessages([
                    'quantity' => 'Stok tidak mencukupi untuk transaksi keluar.',
                ]);
            }

            if ($data['type'] === 'in') {
                $item->increment('stock', $data['quantity']);
            } else {
                $item->decrement('stock', $data['quantity']);
            }

            StockMovement::create([
                'item_id' => $item->id,
                'user_id' => $request->user()->id,
                'type' => $data['type'],
                'quantity' => $data['quantity'],
                'notes' => $data['notes'] ?? null,
            ]);
        });

        return redirect()->route('movements.index')
            ->with('success', 'Transaksi stok berhasil disimpan.');
    }
}