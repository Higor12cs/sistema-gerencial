@extends('adminlte::page')

@section('title', 'Editando Pedido')

@section('content_header')
    <div class="d-flex justify-content-between">
        <x-header>{{ __('Editando Pedido') }}</x-header>
        <a href="{{ route('app.orders.index') }}" class="btn btn-secondary">{{ __('Voltar') }}</a>
    </div>
    <x-alerts />
@stop

@section('content')
    <div class="card">
        <div class="card-header">Editando Pedido</div>
        <div class="card-body">
            @livewire('order.order-edit', ['order' => $order])
        </div>
    </div>
@stop
