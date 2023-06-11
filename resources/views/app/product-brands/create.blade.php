@extends('adminlte::page')

@section('title', __('Nova Marca'))

@section('content_header')
    <div class="d-flex justify-content-between">
        <x-header>{{ __('Nova Marca') }}</x-header>
        <a href="{{ route('app.product-brands.index') }}" class="btn btn-secondary mb-auto">{{ __('Voltar') }}</a>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            {{ __('Nova Marca') }}
        </div>
        <div class="card-body">
            <form action="{{ route('app.product-brands.store') }}" method="POST">
                @csrf

                <div class="row">
                    <x-adminlte-input name="name" label="{{ __('Nome') }}" placeholder="{{ __('Nome') }}"
                        fgroup-class="col-12" />
                </div>

                <button type="submit" class="btn btn-primary mt-2">{{ __('Incluir Marca') }}</button>
            </form>
        </div>
    </div>
@stop
