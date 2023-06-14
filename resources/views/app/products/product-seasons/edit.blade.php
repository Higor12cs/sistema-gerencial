@extends('adminlte::page')

@section('title', __('Editar Temporada'))

@section('content_header')
    <div class="d-flex justify-content-between">
        <x-header>{{ __('Editar Temporada') }}</x-header>
        <a href="{{ route('app.product-seasons.index') }}" class="btn btn-secondary mb-auto">{{ __('Voltar') }}</a>
    </div>
    <x-alerts />
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            {{ __('Editar Temporada') }}
        </div>
        <div class="card-body">
            <form action="{{ route('app.product-seasons.update', $productSeason) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <x-adminlte-input name="name" label="{{ __('Nome') }}" placeholder="{{ __('Nome') }}"
                        fgroup-class="col-12" value="{{ $productSeason->name }}" enable-old-support />
                </div>

                <div class="row">
                    <x-adminlte-select name="active" label="{{ __('Ativo') }}" fgroup-class="col-12">
                        <option>{{ __('-- selecione --') }}</option>
                        <option value="1" @if ($productSeason->active) selected @endif>{{ __('Ativo') }}
                        </option>
                        <option value="0" @if (!$productSeason->active) selected @endif>{{ __('Desativado') }}
                        </option>
                    </x-adminlte-select>
                </div>

                <button type="submit" class="btn btn-primary mt-2">{{ __('Salvar Temporada') }}</button>
            </form>
        </div>
    </div>
@stop
