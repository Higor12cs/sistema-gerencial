@extends('adminlte::page')

@section('title', __('Cores'))

@section('content_header')
    <div class="d-flex justify-content-between">
        <x-header>{{ __('Cores') }}</x-header>
        <a href="{{ route('app.product-colors.create') }}" class="btn btn-primary mb-auto">{{ __('Nova Cor') }}</a>
    </div>
    <x-alerts />
@stop

@php
    $heads = [['label' => __('Código'), 'width' => 10], __('Nome'), ['label' => __('Ativo'), 'width' => 10], ['label' => __('Ações'), 'no-export' => true, 'width' => 5]];

    foreach ($productColors as $productColor) {
        $btnShow = '<a href="' . route('app.product-colors.show', $productColor) . '" class="btn btn-xs btn-default mx-1" title="Visualizar"><i class="fa fa-lg fa-fw fa-eye"></i></a>';
        $btnEdit = '<a href="' . route('app.product-colors.edit', $productColor) . '" class="btn btn-xs btn-default mx-1" title="Editar"><i class="fa fa-lg fa-fw fa-pen"></i></a>';

        $productColorsData[] = [$productColor->id, $productColor->name, $productColor->active ? '<span class="badge badge-success">Ativo</span>' : '<span class="badge badge-danger">Desativado</span>', '<nobr>' . $btnShow . $btnEdit . '</nobr>'];
    }

    $config = [
        'data' => $productColorsData ?? null,
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
            {{ __('Cores') }}
        </div>
        <div class="card-body">
            <x-adminlte-datatable id="colors-table" :heads="$heads" :config="$config" hoverable with-buttons />
        </div>
    </div>
@stop
