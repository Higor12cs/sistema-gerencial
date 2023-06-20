@extends('adminlte::page')

@section('title', __('Visualizar Produto'))

@section('content_header')
    <div class="d-flex justify-content-between">
        <x-header>{{ __('Visualizar Produto') }}</x-header>
        <a href="{{ route('app.products.index') }}" class="btn btn-secondary mb-auto">{{ __('Voltar') }}</a>
    </div>
    <x-alerts />
@stop

@php
    $heads = [['label' => __('Código'), 'width' => 10], __('Nome'), __('Cor'), __('Tamanho'), __('Valor'), __('Estoque'), ['label' => __('Ativo'), 'width' => 10], ['label' => __('Ações'), 'no-export' => true, 'width' => 5]];

    foreach ($productVariants as $productVariant) {
        $btnShow = '<a href="' . route('app.product-variants.show', $productVariant) . '" class="btn btn-xs btn-default mx-1" title="Visualizar"><i class="fa fa-lg fa-fw fa-eye"></i></a>';
        $btnEdit = '<a href="' . route('app.product-variants.edit', $productVariant) . '" class="btn btn-xs btn-default mx-1" title="Editar"><i class="fa fa-lg fa-fw fa-pen"></i></a>';

        $productVariantsData[] = [$productVariant->id, $productVariant->name, $productVariant->productColor->name ?? '-', $productVariant->productSize->name ?? '-', number_format($productVariant->price / 100, 2, ',', '.'), number_format($productVariant->quantity / 100, 2, ',', '.'), $productVariant->active ? '<span class="badge badge-success">Ativo</span>' : '<span class="badge badge-danger">Desativado</span>', '<nobr>' . $btnShow . $btnEdit . '</nobr>'];
    }

    $config = [
        'data' => $productVariantsData ?? null,
        'order' => [[0, 'desc']],
        'columns' => [null, null, null, null, null, null, null, ['orderable' => false]],
        'searching' => false,
        'info' => false,
        'paging' => false,
        'language' => [
            'url' => '//cdn.datatables.net/plug-ins/1.13.4/i18n/pt-BR.json',
        ],
    ];
@endphp

@section('content')
    <div class="card">
        <div class="card-header">
            {{ __('Visualizar Produto') }}
        </div>
        <div class="card-body">
            <div class="row">
                <x-adminlte-input name="name" label="{{ __('Nome') }}" fgroup-class="col-12" value="{{ $product->name }}"
                    disabled />
            </div>

            <div class="row">
                <x-adminlte-select name="product_brand_id" label="{{ __('Marca') }}" fgroup-class="col-lg-4" disabled>
                    <option value="">{{ __('-') }}</option>
                    @foreach ($productBrands as $productBrand)
                        <option value="{{ $productBrand->id }}" @if ($productBrand->id === $product->product_brand_id) selected @endif>
                            {{ $productBrand->name }}</option>
                    @endforeach
                </x-adminlte-select>

                <x-adminlte-select name="product_category_id" label="{{ __('Categoria') }}" fgroup-class="col-lg-4"
                    disabled>
                    <option value="">{{ __('-') }}</option>
                    @foreach ($productCategories as $productCategory)
                        <option value="{{ $productCategory->id }}" @if ($productCategory->id === $product->product_category_id) selected @endif>
                            {{ $productCategory->name }}</option>
                    @endforeach
                </x-adminlte-select>

                <x-adminlte-select name="product_season_id" label="{{ __('Temporada') }}" fgroup-class="col-lg-4" disabled>
                    <option value="">{{ __('-') }}</option>
                    @foreach ($productSeasons as $productSeason)
                        <option value="{{ $productSeason->id }}" @if ($productSeason->id === $product->product_season_id) selected @endif>
                            {{ $productSeason->name }}</option>
                    @endforeach
                </x-adminlte-select>
            </div>

            <div class="row">
                <x-adminlte-select name="active" label="{{ __('Ativo') }}" fgroup-class="col-12" disabled>
                    <option>{{ __('-') }}</option>
                    <option value="1" @if ($product->active) selected @endif>{{ __('Ativo') }}
                    </option>
                    <option value="0" @if (!$product->active) selected @endif>{{ __('Desativado') }}
                    </option>
                </x-adminlte-select>
            </div>

            <div class="d-flex justify-content-between mt-2">
                <a href="{{ route('app.products.edit', $product) }}"
                    class="btn btn-primary">{{ __('Editar Produto') }}</a>
                <button class="btn btn-danger" disabled>{{ __('Excluir Produto') }}</button>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            {{ __('Variações do Produto') }}
        </div>
        <div class="card-body">
            <x-adminlte-datatable id="product-variants-table" :heads="$heads" :config="$config" hoverable />
            <div class="d-flex justify-content-between mt-2">
                <a href="{{ route('app.product-variants.create', ['product_id' => $product->id]) }}"
                    class="btn btn-primary">{{ __('Nova Variação') }}</a>
            </div>
        </div>
    </div>
@stop
