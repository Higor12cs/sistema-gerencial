@extends('adminlte::page')

@section('title', 'Editando Condicional')

@section('content_header')
    <div class="d-flex justify-content-between">
        <x-header>{{ __('Editando Condicional') }}</x-header>
        <a href="{{ route('app.trials.index') }}" class="btn btn-secondary">{{ __('Voltar') }}</a>
    </div>
    <x-alerts />
@stop

@section('content')
    <div class="card">
        <div class="card-header">Editando Condicional</div>
        <div class="card-body">
            @livewire('trial.trial-edit', ['trial' => $trial])
        </div>
    </div>
@stop
