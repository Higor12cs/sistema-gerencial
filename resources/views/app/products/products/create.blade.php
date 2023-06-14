@extends('adminlte::page')

@section('title', __('Nova Marca'))

@section('content_header')
    <div class="d-flex justify-content-between">
        <x-header>{{ __('Nova Marca') }}</x-header>
        <a href="{{ route('app.products.index') }}" class="btn btn-secondary mb-auto">{{ __('Voltar') }}</a>
    </div>
    <x-alerts />
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            {{ __('Nova Marca') }}
        </div>
        <div class="card-body">
            <form action="{{ route('app.products.store') }}" method="POST">
                @csrf

                <div class="row">
                    <x-adminlte-input name="name" label="{{ __('Nome') }}" placeholder="{{ __('Nome') }}"
                        fgroup-class="col-12" enable-old-support />
                </div>

                <div class="row">
                    <x-adminlte-select name="product_brand_id" label="{{ __('Marca') }}" fgroup-class="col-lg-4"
                        enable-old-support>
                        <option value="">{{ __('-- selecione --') }}</option>
                        @foreach ($productBrands as $productBrand)
                            <option value="{{ $productBrand->id }}">{{ $productBrand->name }}</option>
                        @endforeach
                    </x-adminlte-select>

                    <x-adminlte-select name="product_category_id" label="{{ __('Categoria') }}" fgroup-class="col-lg-4"
                        enable-old-support>
                        <option value="">{{ __('-- selecione --') }}</option>
                        @foreach ($productCategories as $productCategory)
                            <option value="{{ $productCategory->id }}">{{ $productCategory->name }}</option>
                        @endforeach
                    </x-adminlte-select>

                    <x-adminlte-select name="product_season_id" label="{{ __('Temporada') }}" fgroup-class="col-lg-4"
                        enable-old-support>
                        <option value="">{{ __('-- selecione --') }}</option>
                        @foreach ($productSeasons as $productSeason)
                            <option value="{{ $productSeason->id }}">{{ $productSeason->name }}</option>
                        @endforeach
                    </x-adminlte-select>
                </div>

                <button type="submit" class="btn btn-primary mt-2">{{ __('Incluir Produto') }}</button>
            </form>
        </div>
    </div>
@stop
