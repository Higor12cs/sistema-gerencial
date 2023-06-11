@extends('adminlte::page')

@section('title', __('Visualizar Categoria'))

@section('content_header')
    <div class="d-flex justify-content-between">
        <x-header>{{ __('Visualizar Categoria') }}</x-header>
        <a href="{{ route('app.product-categories.index') }}" class="btn btn-secondary mb-auto">{{ __('Voltar') }}</a>
    </div>
    <x-alerts />
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            {{ __('Visualizar Categoria') }}
        </div>
        <div class="card-body">
            <div class="row">
                <x-adminlte-input name="name" label="{{ __('Nome') }}" fgroup-class="col-12"
                    value="{{ $productCategory->name }}" disabled />
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('app.product-categories.edit', $productCategory) }}" type="submit"
                    class="btn btn-primary mt-2">{{ __('Incluir Categoria') }}</a>

                <form action="{{ route('app.product-categories.destroy', $productCategory) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger"
                        onclick="return confirm('{{ __('Tem certeza que deseja excluir esta categoria? Esta ação não poderá ser desfeita.') }}')">{{ __('Excluir Categoria') }}</button>
                </form>
            </div>
        </div>
    </div>
@stop
