@extends('adminlte::page')

@section('title', 'Estoque')

@section('content_header')
    <x-header>{{ __('Estoque') }}</x-header>
    <x-alerts />
@stop

@php
    $heads = [['label' => __('Código'), 'width' => 10], __('Nome'), __('Marca'), __('Categoria'), __('Estoque Total'), __('Estoque em Condicionais'), ['label' => __('Ativo'), 'width' => 10], ['label' => __('Ações'), 'no-export' => true, 'width' => 5]];
    
    foreach ($products as $product) {
        $btnShow = '<a href="' . route('app.products.show', $product) . '" class="btn btn-xs btn-default mx-1" title="Visualizar"><i class="fa fa-lg fa-fw fa-eye"></i></a>';
        $btnEdit = '<a href="' . route('app.products.edit', $product) . '" class="btn btn-xs btn-default mx-1" title="Editar"><i class="fa fa-lg fa-fw fa-pen"></i></a>';
    
        $productsData[] = [$product->id, $product->name, $product->productBrand->name ?? '-', $product->productCategory->name ?? '-', number_format($product->total_stock / 100, 2, '.', ','), number_format($product->total_on_trials / 100, 2, '.', ','), $product->active ? '<span class="badge badge-success">Ativo</span>' : '<span class="badge badge-danger">Desativado</span>', '<nobr>' . $btnShow . $btnEdit . '</nobr>'];
    }
    
    $config = [
        'data' => $productsData ?? null,
        'order' => [[0, 'desc']],
        'columns' => [null, null, null, null, null, null, null, ['orderable' => false]],
        'language' => [
            'url' => '//cdn.datatables.net/plug-ins/1.13.4/i18n/pt-BR.json',
        ],
        'pageLength' => 50,
    ];
@endphp

@section('content')
    <div class="card">
        <div class="card-header">Estoque</div>
        <div class="card-body">
            <x-adminlte-datatable id="products-table" class="hidden" :heads="$heads" :config="$config" hoverable />
        </div>
    </div>
@stop
