<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use App\Models\StockMovement;

class DashboardController extends Controller
{
    public function index()
    {
        $totalItems = Item::count();
        $totalCategories = Category::count();

        $lowStock = Item::whereColumn(
            'stock', '<=', 'minimum_stock'
        )->count();

        $todayMovements = StockMovement::whereDate(
            'created_at', today()
        )->count();

        return view('dashboard', compact(
            'totalItems',
            'totalCategories',
            'lowStock',
            'todayMovements'
        ));
    }
}