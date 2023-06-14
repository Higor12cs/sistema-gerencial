@extends('adminlte::page')

@section('title', __('Visualizar Cor'))

@section('content_header')
    <div class="d-flex justify-content-between">
        <x-header>{{ __('Visualizar Cor') }}</x-header>
        <a href="{{ route('app.product-colors.index') }}" class="btn btn-secondary mb-auto">{{ __('Voltar') }}</a>
    </div>
    <x-alerts />
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            {{ __('Visualizar Cor') }}
        </div>
        <div class="card-body">
            <div class="row">
                <x-adminlte-input name="name" label="{{ __('Nome') }}" fgroup-class="col-12"
                    value="{{ $productColor->name }}" disabled />
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('app.product-colors.edit', $productColor) }}" type="submit"
                    class="btn btn-primary mt-2">{{ __('Incluir Cor') }}</a>

                <form action="{{ route('app.product-colors.destroy', $productColor) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger"
                        onclick="return confirm('{{ __('Tem certeza que deseja excluir esta cor? Esta ação não poderá ser desfeita.') }}')">{{ __('Excluir Cor') }}</button>
                </form>
            </div>
        </div>
    </div>
@stop
