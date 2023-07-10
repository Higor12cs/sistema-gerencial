@extends('adminlte::page')

@section('title', __('Temporadas'))

@section('content_header')
    <div class="d-flex justify-content-between">
        <x-header>{{ __('Temporadas') }}</x-header>
        <a href="{{ route('app.product-seasons.create') }}" class="btn btn-primary mb-auto">{{ __('Nova Categoria') }}</a>
    </div>
    <x-alerts />
@stop

@php
    $heads = [['label' => __('Código'), 'width' => 10], __('Nome'), ['label' => __('Ativo'), 'width' => 10], ['label' => __('Ações'), 'no-export' => true, 'width' => 5]];

    foreach ($productSeasons as $productSeason) {
        $btnShow = '<a href="' . route('app.product-seasons.show', $productSeason) . '" class="btn btn-xs btn-default mx-1" title="Visualizar"><i class="fa fa-lg fa-fw fa-eye"></i></a>';
        $btnEdit = '<a href="' . route('app.product-seasons.edit', $productSeason) . '" class="btn btn-xs btn-default mx-1" title="Editar"><i class="fa fa-lg fa-fw fa-pen"></i></a>';

        $productSeasonsData[] = [$productSeason->id, $productSeason->name, $productSeason->active ? '<span class="badge badge-success">Ativo</span>' : '<span class="badge badge-danger">Desativado</span>', '<nobr>' . $btnShow . $btnEdit . '</nobr>'];
    }

    $config = [
        'data' => $productSeasonsData ?? null,
        'order' => [[0, 'desc']],
        'columns' => [null, null, null, ['orderable' => false]],
        'language' => [
            'url' => '//cdn.datatables.net/plug-ins/1.13.4/i18n/pt-BR.json',
        ],
        'pageLength' => 50,
    ];
@endphp

@section('content')
    <div class="card">
        <div class="card-header">
            {{ __('Temporadas') }}
        </div>
        <div class="card-body">
            <x-adminlte-datatable id="seasons-table" :heads="$heads" :config="$config" hoverable />
        </div>
    </div>
@stop
