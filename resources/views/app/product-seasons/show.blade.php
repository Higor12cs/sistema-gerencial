@extends('adminlte::page')

@section('title', __('Visualizar Temporada'))

@section('content_header')
    <div class="d-flex justify-content-between">
        <x-header>{{ __('Visualizar Temporada') }}</x-header>
        <a href="{{ route('app.product-seasons.index') }}" class="btn btn-secondary mb-auto">{{ __('Voltar') }}</a>
    </div>
    <x-alerts />
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            {{ __('Visualizar Temporada') }}
        </div>
        <div class="card-body">
            <div class="row">
                <x-adminlte-input name="name" label="{{ __('Nome') }}" fgroup-class="col-12"
                    value="{{ $productSeason->name }}" disabled />
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('app.product-seasons.edit', $productSeason) }}" type="submit"
                    class="btn btn-primary mt-2">{{ __('Incluir Temporada') }}</a>

                <form action="{{ route('app.product-seasons.destroy', $productSeason) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger"
                        onclick="return confirm('{{ __('Tem certeza que deseja excluir esta temporada? Esta ação não poderá ser desfeita.') }}')">{{ __('Excluir Temporada') }}</button>
                </form>
            </div>
        </div>
    </div>
@stop
