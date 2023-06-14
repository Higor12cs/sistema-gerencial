@extends('adminlte::page')

@section('title', __('Nova Temporada'))

@section('content_header')
    <div class="d-flex justify-content-between">
        <x-header>{{ __('Nova Temporada') }}</x-header>
        <a href="{{ route('app.product-seasons.index') }}" class="btn btn-secondary mb-auto">{{ __('Voltar') }}</a>
    </div>
    <x-alerts />
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            {{ __('Nova Temporada') }}
        </div>
        <div class="card-body">
            <form action="{{ route('app.product-seasons.store') }}" method="POST">
                @csrf

                <div class="row">
                    <x-adminlte-input name="name" label="{{ __('Nome') }}" placeholder="{{ __('Nome') }}"
                        fgroup-class="col-12" />
                </div>

                <button type="submit" class="btn btn-primary mt-2">{{ __('Incluir Temporada') }}</button>
            </form>
        </div>
    </div>
@stop
