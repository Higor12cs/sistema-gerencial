@extends('adminlte::page')

@section('title', 'Novo Condicional')

@section('content_header')
    <div class="d-flex justify-content-between">
        <x-header>{{ __('Novo Condicional') }}</x-header>
        <a href="{{ route('app.trials.index') }}" class="btn btn-secondary">{{ __('Voltar') }}</a>
    </div>
    <x-alerts />
@stop

@section('content')
    <div class="card">
        <div class="card-header">Novo Condicional</div>
        <div class="card-body">
            @livewire('trial.trial-create')
        </div>
    </div>
@stop
