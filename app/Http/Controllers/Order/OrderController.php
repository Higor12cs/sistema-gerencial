<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(): View
    {
        $orders = Order::with('customer')->get();

        return view('app.orders.index', compact('orders'));
    }

    public function create(): View
    {
        $customers = Customer::where('active', true)->get();
        $products = Product::where('active', true)
            ->orderBy('name')
            ->get();

        return view('app.orders.create', compact('customers', 'products'));
    }

    public function show(Order $order)
    {
        $orderItems = OrderItem::where('order_id', $order->id)
            ->with('product')
            ->get();

        return view('app.orders.show', compact('order', 'orderItems'));
    }

    public function edit(Order $order): View
    {
        $customers = Customer::all();
        $products = Product::query()
            ->with('productSize')
            ->orderBy('name')
            ->get();

        return view('app.orders.edit', compact('order', 'customers', 'products'));
    }

    public function destroy(Order $order): RedirectResponse
    {
        OrderItem::where('order_id', $order->id)->delete();
        $order->delete();

        return to_route('app.orders.index')->with('success', 'Pedido excluído com sucesso!');
    }
}
