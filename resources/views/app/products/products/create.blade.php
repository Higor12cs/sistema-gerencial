@extends('adminlte::page')

@section('title', __('Novo Produto'))

@section('content_header')
    <div class="d-flex justify-content-between">
        <x-header>{{ __('Novo Produto') }}</x-header>
        <a href="{{ route('app.products.index') }}" class="btn btn-secondary mb-auto">{{ __('Voltar') }}</a>
    </div>
    <x-alerts />
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            {{ __('Novo Produto') }}
        </div>
        <div class="card-body">
            @livewire('product.product-create', [
                'productBrands' => $productBrands,
                'productCategories' => $productCategories,
                'productSeasons' => $productSeasons,
                'productSizes' => $productSizes,
            ])
        </div>
    </div>
@stop
