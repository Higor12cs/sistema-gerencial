@extends('adminlte::page')

@section('title', 'Pedido')

@section('content_header')
    <div class="d-flex justify-content-between">
        <x-header>Visualizar Pedido</x-header>
        <a href="{{ route('app.orders.index') }}" class="btn btn-secondary">Voltar</a>
    </div>
    <x-alerts />
@stop

@section('content')
    <div class="card">
        <div class="card-header">Pedido #{{ str_pad($order->id, 4, 0, STR_PAD_LEFT) }}</div>
        <div class="card-body">
            <div class="px-3 py-2 border">
                <x-adminlte-input name="customer" label="Cliente" value="{{ $order->customer->name }}" disabled />
            </div>

            <div class="table-responsive mt-4">
                <table class="table table-bordered table-hover">
                    <thead>
                        <th class="col-1">#</th>
                        <th class="col-8">Produto</th>
                        <th class="col-1">Quantidade</th>
                        <th class="col-1 text-nowrap">Valor Unit.</th>
                        <th class="col-1 text-nowrap">Valor Total</th>
                    </thead>
                    <tbody>
                        @foreach ($orderItems as $orderItem)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $orderItem->productVariant->product->name . ' - ' . str_pad($orderItem->product_variant_id, 4, 0, STR_PAD_LEFT) }}</td>
                                <td>{{ number_format($orderItem->quantity / 100, 2, ',', '.') }}</td>
                                <td>{{ number_format($orderItem->unit_price / 100, 2, ',', '.') }}</td>
                                <td>{{ number_format($orderItem->total_price / 100, 2, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-end mt-2">
                <h4 class="m-0">Total R${{ number_format($order->total_price / 100, 2, ',', '.') }}</h4>
            </div>
        </div>
    </div>
@stop
