@extends('adminlte::page')

@section('title', 'Clientes')

@section('content_header')
    <div class="d-flex justify-content-between">
        <x-header>{{ __('Clientes') }}</x-header>
        <a href="{{ route('app.customers.create') }}" class="btn btn-primary mb-auto">{{ __('Novo Cliente') }}</a>
    </div>
    <x-alerts />
@stop

@php
    $heads = [['label' => __('Código'), 'width' => 10], __('Nome'), __('Endereço'), __('Número'), __('Telefone 1'), ['label' => __('Ações'), 'no-export' => true, 'width' => 5]];

    foreach ($customers as $customer) {
        $btnShow = '<a href="' . route('app.customers.show', $customer) . '" class="btn btn-xs btn-default mx-1" title="Visualizar"><i class="fa fa-lg fa-fw fa-eye"></i></a>';
        $btnEdit = '<a href="' . route('app.customers.edit', $customer) . '" class="btn btn-xs btn-default mx-1" title="Editar"><i class="fa fa-lg fa-fw fa-pen"></i></a>';

        $customersData[] = [$customer->id, $customer->name, $customer->address, $customer->number, $customer->phone1, '<nobr>' . $btnShow . $btnEdit . '</nobr>'];
    }

    $config = [
        'data' => $customersData ?? null,
        'order' => [[0, 'desc']],
        'columns' => [null, null, null, null, null, ['orderable' => false]],
        'language' => [
            'url' => '//cdn.datatables.net/plug-ins/1.13.4/i18n/pt-BR.json',
        ],
    ];
@endphp

@section('content')
    <div class="card">
        <div class="card-header">
            {{ __('Clientes') }}
        </div>
        <div class="card-body">
            <x-adminlte-datatable id="customers-table" :heads="$heads" :config="$config" hoverable with-buttons />
        </div>
    </div>
@stop
