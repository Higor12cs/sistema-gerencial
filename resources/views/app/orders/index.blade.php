@extends('adminlte::page')

@section('title', 'Pedidos')

@section('content_header')
    <div class="d-flex justify-content-between">
        <x-header>{{ __('Pedidos') }}</x-header>
        <a href="{{ route('app.orders.create') }}" class="btn btn-primary">{{ __('Novo Pedido') }}</a>
    </div>
    <x-alerts />
@stop

@php
    $heads = [['label' => __('Código'), 'width' => 10], __('Cliente'), __('Data'), __('Valor Total'), ['label' => __('Ações'), 'no-export' => true, 'width' => 5]];
    
    foreach ($orders as $order) {
        $btnShow = '<a href="' . route('app.orders.show', $order) . '" class="btn btn-xs btn-default mx-1" title="Visualizar"><i class="fa fa-lg fa-fw fa-eye"></i></a>';
        $btnEdit = '<a href="' . route('app.orders.edit', $order) . '" class="btn btn-xs btn-default mx-1" title="Editar"><i class="fa fa-lg fa-fw fa-pen"></i></a>';
    
        $ordersData[] = [$order->id, $order->customer->name, $order->date->format('d/m/Y'), number_format($order->total_price / 100, 2, ',', '.'), '<nobr>' . $btnShow . $btnEdit . '</nobr>'];
    }
    
    $config = [
        'data' => $ordersData ?? null,
        'order' => [[0, 'desc']],
        'columns' => [null, null, null, null, ['orderable' => false]],
        'language' => [
            'url' => '//cdn.datatables.net/plug-ins/1.13.4/i18n/pt-BR.json',
        ],
        'pageLength' => 50,
    ];
@endphp

@section('content')
    <div class="card">
        <div class="card-header">Pedidos</div>
        <div class="card-body">
            <x-adminlte-datatable id="orders-table" class="hidden" :heads="$heads" :config="$config" hoverable />
        </div>
    </div>
@stop
