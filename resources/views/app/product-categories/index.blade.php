@extends('adminlte::page')

@section('title', __('Categorias'))

@section('content_header')
    <div class="d-flex justify-content-between">
        <x-header>{{ __('Categorias') }}</x-header>
        <a href="{{ route('app.product-categories.create') }}" class="btn btn-primary mb-auto">{{ __('Nova Categoria') }}</a>
    </div>
    <x-alerts />
@stop

@php
    $heads = [['label' => __('Código'), 'width' => 10], __('Nome'), ['label' => __('Ativo'), 'width' => 10], ['label' => __('Ações'), 'no-export' => true, 'width' => 5]];

    foreach ($productCategories as $productCategory) {
        $btnShow = '<a href="' . route('app.product-categories.show', $productCategory) . '" class="btn btn-xs btn-default mx-1" title="Visualizar"><i class="fa fa-lg fa-fw fa-eye"></i></a>';
        $btnEdit = '<a href="' . route('app.product-categories.edit', $productCategory) . '" class="btn btn-xs btn-default mx-1" title="Editar"><i class="fa fa-lg fa-fw fa-pen"></i></a>';

        $productCategoriesData[] = [$productCategory->id, $productCategory->name, $productCategory->active ? '<span class="badge badge-success">Ativo</span>' : '<span class="badge badge-danger">Desativado</span>', '<nobr>' . $btnShow . $btnEdit . '</nobr>'];
    }

    $config = [
        'data' => $productCategoriesData ?? null,
        'order' => [[0, 'desc']],
        'columns' => [null, null, null, ['orderable' => false]],
        'language' => [
            'url' => '//cdn.datatables.net/plug-ins/1.13.4/i18n/pt-BR.json',
        ],
    ];
@endphp

@section('content')
    <div class="card">
        <div class="card-header">
            {{ __('Categorias') }}
        </div>
        <div class="card-body">
            <x-adminlte-datatable id="categories-table" :heads="$heads" :config="$config" hoverable with-buttons />
        </div>
    </div>
@stop
