@extends('adminlte::page')

@section('title', __('Visualizar Marca'))

@section('content_header')
    <div class="d-flex justify-content-between">
        <x-header>{{ __('Visualizar Marca') }}</x-header>
        <a href="{{ route('app.product-brands.index') }}" class="btn btn-secondary mb-auto">{{ __('Voltar') }}</a>
    </div>
    <x-alerts />
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            {{ __('Visualizar Marca') }}
        </div>
        <div class="card-body">
            <div class="row">
                <x-adminlte-input name="name" label="{{ __('Nome') }}" fgroup-class="col-12"
                    value="{{ $productBrand->name }}" disabled />
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('app.product-brands.edit', $productBrand) }}" type="submit"
                    class="btn btn-primary mt-2">{{ __('Incluir Marca') }}</a>

                <form action="{{ route('app.product-brands.destroy', $productBrand) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger"
                        onclick="return confirm('{{ __('Tem certeza que deseja excluir esta marca? Esta ação não poderá ser desfeita.') }}')">{{ __('Excluir Marca') }}</button>
                </form>
            </div>
        </div>
    </div>
@stop
