@extends('adminlte::page')

@section('title', __('Nova Variação'))

@section('content_header')
    <div class="d-flex justify-content-between">
        <x-header>{{ __('Nova Variação') }}</x-header>
        <a href="{{ route('app.products.index') }}" class="btn btn-secondary mb-auto">{{ __('Voltar') }}</a>
    </div>
    <x-alerts />
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            {{ __('Nova Variação') }}
        </div>
        <div class="card-body">
            <form action="{{ route('app.product-variants.store') }}" method="POST">
                @csrf

                <input type="hidden" name="product_id" value="{{ $productId }}">

                <div class="row">
                    <x-adminlte-input name="name" label="{{ __('Nome') }}" placeholder="{{ __('Nome') }}"
                        fgroup-class="col-12" enable-old-support />
                </div>

                <div class="row">
                    <x-adminlte-input name="sku" label="{{ __('Código SKU') }}" placeholder="{{ __('SKU') }}"
                        fgroup-class="col-lg-6" enable-old-support />

                    <x-adminlte-input name="barcode" label="{{ __('Código de Barras') }}"
                        placeholder="{{ __('123') }}" fgroup-class="col-lg-6" enable-old-support />
                </div>

                <div class="row">
                    <x-adminlte-input name="price" type="number" step="any" label="{{ __('Valor Venda') }}"
                        placeholder="{{ __('Preço') }}" fgroup-class="col-12" enable-old-support />
                </div>

                <div class="row">
                    <x-adminlte-select name="product_color_id" label="{{ __('Cor') }}" fgroup-class="col-lg-6"
                        enable-old-support>
                        <option value="">{{ __('-- selecione --') }}</option>
                        @foreach ($productColors as $productColor)
                            <option value="{{ $productColor->id }}">{{ $productColor->name }}</option>
                        @endforeach
                    </x-adminlte-select>

                    <x-adminlte-select name="product_size_id" label="{{ __('Tamanho') }}" fgroup-class="col-lg-6"
                        enable-old-support>
                        <option value="">{{ __('-- selecione --') }}</option>
                        @foreach ($productSizes as $productSize)
                            <option value="{{ $productSize->id }}">{{ $productSize->name }}</option>
                        @endforeach
                    </x-adminlte-select>
                </div>

                <button type="submit" class="btn btn-primary mt-2">{{ __('Incluir Variação') }}</button>
            </form>
        </div>
    </div>
@stop
