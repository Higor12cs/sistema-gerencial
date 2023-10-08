@extends('adminlte::page')

@section('title', 'Novo Pedido')

@section('content_header')
    <div class="d-flex justify-content-between">
        <x-header>{{ __('Novo Pedido') }}</x-header>
        <a href="{{ route('app.orders.index') }}" class="btn btn-secondary">{{ __('Voltar') }}</a>
    </div>
    <x-alerts />
@stop

@section('content')
    <div class="card">
        <div class="card-header">Novo Pedido</div>
        <div class="card-body">
            @livewire('order.order-create')
        </div>
    </div>
@stop
