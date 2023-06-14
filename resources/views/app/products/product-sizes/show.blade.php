@extends('adminlte::page')

@section('title', __('Visualizar Tamanho'))

@section('content_header')
    <div class="d-flex justify-content-between">
        <x-header>{{ __('Visualizar Tamanho') }}</x-header>
        <a href="{{ route('app.product-sizes.index') }}" class="btn btn-secondary mb-auto">{{ __('Voltar') }}</a>
    </div>
    <x-alerts />
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            {{ __('Visualizar Tamanho') }}
        </div>
        <div class="card-body">
            <div class="row">
                <x-adminlte-input name="name" label="{{ __('Nome') }}" fgroup-class="col-12"
                    value="{{ $productSize->name }}" disabled />
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('app.product-sizes.edit', $productSize) }}" type="submit"
                    class="btn btn-primary mt-2">{{ __('Incluir Tamanho') }}</a>

                <form action="{{ route('app.product-sizes.destroy', $productSize) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger"
                        onclick="return confirm('{{ __('Tem certeza que deseja excluir este tamanho? Esta ação não poderá ser desfeita.') }}')">{{ __('Excluir Tamanho') }}</button>
                </form>
            </div>
        </div>
    </div>
@stop
