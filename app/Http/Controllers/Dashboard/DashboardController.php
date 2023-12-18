<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $orderValueSum = \App\Models\Order::whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()])->sum('total_price');
        $trialCount = \App\Models\Trial::whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()])->count();
        $customersCount = \App\Models\Customer::whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()])->count();
        $itemsOrderedSum = \App\Models\OrderItem::whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()])->sum('quantity');

        return view('app.dashboard.index', compact(
            'orderValueSum',
            'trialCount',
            'customersCount',
            'itemsOrderedSum'
        ));
    }
}
