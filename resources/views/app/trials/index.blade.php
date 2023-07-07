@extends('adminlte::page')

@section('title', 'Condicionais')

@section('content_header')
    <div class="d-flex justify-content-between">
        <x-header>{{ __('Condicionais') }}</x-header>
        <button class="btn btn-primary">{{ __('Novo') }}</button>
    </div>
    <x-alerts />
@stop

@php
    $heads = [['label' => __('Código'), 'width' => 10], __('Cliente'), __('Data'), __('Data Retorno'), ['label' => __('Status'), 'width' => 10], ['label' => __('Ações'), 'no-export' => true, 'width' => 5]];

    foreach ($trials as $trial) {
        $btnShow = '<a href="' . route('app.trials.show', $trial) . '" class="btn btn-xs btn-default mx-1" title="Visualizar"><i class="fa fa-lg fa-fw fa-eye"></i></a>';
        $btnEdit = '<a href="' . route('app.trials.edit', $trial) . '" class="btn btn-xs btn-default mx-1" title="Editar"><i class="fa fa-lg fa-fw fa-pen"></i></a>';

        $trialsData[] = [$trial->id, $trial->customer->name, $trial->date->format('d/m/Y'), $trial->return_date->format('d/m/Y'), 'Aguardando', '<nobr>' . $btnShow . $btnEdit . '</nobr>'];
    }

    $config = [
        'data' => $trialsData ?? null,
        'order' => [[0, 'desc']],
        'columns' => [null, null, null, null, null, null, ['orderable' => false]],
        'language' => [
            'url' => '//cdn.datatables.net/plug-ins/1.13.4/i18n/pt-BR.json',
        ],
    ];
@endphp

@section('content')
    <div class="card">
        <div class="card-header">Condicionais</div>
        <div class="card-body">
            <x-adminlte-datatable id="trials-table" class="hidden" :heads="$heads" :config="$config" hoverable
                with-buttons />
        </div>
    </div>
@stop
