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
            <form action="{{ route('app.products.store') }}" method="POST">
                @csrf

                <div class="row">
                    <x-adminlte-input name="name" label="{{ __('Nome') }}" placeholder="{{ __('Nome') }}"
                        fgroup-class="col-12" enable-old-support autocomplete="off" />
                </div>

                <div class="row">
                    <x-adminlte-select name="product_brand_id" label="{{ __('Marca') }}" fgroup-class="col-md-6"
                        enable-old-support>
                        <option value="">{{ __('-- selecione --') }}</option>
                        @foreach ($productBrands as $productBrand)
                            <option value="{{ $productBrand->id }}">{{ $productBrand->name }}</option>
                        @endforeach
                    </x-adminlte-select>

                    <x-adminlte-select name="product_category_id" label="{{ __('Categoria') }}" fgroup-class="col-md-6"
                        enable-old-support>
                        <option value="">{{ __('-- selecione --') }}</option>
                        @foreach ($productCategories as $productCategory)
                            <option value="{{ $productCategory->id }}">{{ $productCategory->name }}</option>
                        @endforeach
                    </x-adminlte-select>
                </div>

                <div class="row">
                    <x-adminlte-select name="product_season_id" label="{{ __('Temporada') }}" fgroup-class="col-md-6"
                        enable-old-support>
                        <option value="">{{ __('-- selecione --') }}</option>
                        @foreach ($productSeasons as $productSeason)
                            <option value="{{ $productSeason->id }}">{{ $productSeason->name }}</option>
                        @endforeach
                    </x-adminlte-select>

                    <x-adminlte-select name="product_size_id" label="{{ __('Tamanho') }}" fgroup-class="col-md-6"
                        enable-old-support>
                        <option value="">{{ __('-- selecione --') }}</option>
                        @foreach ($productSizes as $productSize)
                            <option value="{{ $productSize->id }}">{{ $productSize->name }}</option>
                        @endforeach
                    </x-adminlte-select>
                </div>

                <div class="row">
                    <x-adminlte-input name="cost" type="number" step="any" label="{{ __('Custo') }}"
                        placeholder="{{ __('Custo') }}" fgroup-class="col-md-6" enable-old-support autocomplete="off" />

                    <x-adminlte-input name="price" type="number" step="any" label="{{ __('Preço') }}"
                        placeholder="{{ __('Preço') }}" fgroup-class="col-md-6" enable-old-support autocomplete="off" />
                </div>

                <button type="submit" class="btn btn-primary mt-2">{{ __('Salvar Produto') }}</button>
            </form>
        </div>
    </div>
@stop
