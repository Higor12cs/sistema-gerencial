@extends('adminlte::page')

@section('title', __('Visualizar Variação'))

@section('content_header')
    <div class="d-flex justify-content-between">
        <x-header>{{ __('Visualizar Variação') }}</x-header>
        <a href="{{ route('app.products.index') }}" class="btn btn-secondary mb-auto">{{ __('Voltar') }}</a>
    </div>
    <x-alerts />
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            {{ __('Visualizar Variação') }}
        </div>
        <div class="card-body">
            <div class="row">
                <x-adminlte-input name="name" label="{{ __('Nome') }}" placeholder="{{ __('Nome') }}"
                    fgroup-class="col-12" disabled value="{{ $productVariant->name }}" />
            </div>

            <div class="row">
                <x-adminlte-input name="sku" label="{{ __('Código SKU') }}" placeholder="{{ __('SKU') }}"
                    fgroup-class="col-lg-6" disabled value="{{ $productVariant->sku }}" />

                <x-adminlte-input name="barcode" label="{{ __('Código de Barras') }}" placeholder="{{ __('123') }}"
                    fgroup-class="col-lg-6" disabled value="{{ $productVariant->barcode }}" />
            </div>

            <div class="row">
                <x-adminlte-input name="price" type="number" step="any" label="{{ __('Valor Venda') }}"
                    placeholder="{{ __('Preço') }}" fgroup-class="col-12" disabled
                    value="{{ $productVariant->price / 100 }}" />
            </div>

            <div class="row">
                <x-adminlte-select name="product_color_id" label="{{ __('Cor') }}" fgroup-class="col-lg-6" disabled>
                    <option value="">{{ __('-- selecione --') }}</option>
                    @foreach ($productColors as $productColor)
                        <option value="{{ $productColor->id }}" @if ($productVariant->product_color_id == $productColor->id) selected @endif>
                            {{ $productColor->name }}</option>
                    @endforeach
                </x-adminlte-select>

                <x-adminlte-select name="product_size_id" label="{{ __('Tamanho') }}" fgroup-class="col-lg-6" disabled>
                    <option value="">{{ __('-- selecione --') }}</option>
                    @foreach ($productSizes as $productSize)
                        <option value="{{ $productSize->id }}" @if ($productVariant->product_size_id == $productSize->id) selected @endif>
                            {{ $productSize->name }}</option>
                    @endforeach
                </x-adminlte-select>

                <x-adminlte-select name="active" label="{{ __('Ativo') }}" fgroup-class="col-12" disabled>
                    <option value="">{{ __('-- selecione --') }}</option>
                    <option value="1" @if ($productVariant->active == 1) selected @endif>{{ __('Ativo') }}
                    </option>
                    <option value="0" @if ($productVariant->active == 0) selected @endif>{{ __('Desativado') }}
                    </option>
                </x-adminlte-select>
            </div>

            <a href="{{ route('app.product-variants.edit', $productVariant) }}"
                class="btn btn-primary mt-2">{{ __('Editar Variação') }}</a>
        </div>
    </div>
@stop
