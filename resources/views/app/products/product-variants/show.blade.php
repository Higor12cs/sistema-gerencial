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
                <x-adminlte-input name="sku" label="{{ __('Código SKU') }}" fgroup-class="col-lg-4" disabled
                    value="{{ $productVariant->sku }}" />

                <x-adminlte-input name="barcode" label="{{ __('Código de Barras') }}" fgroup-class="col-lg-4" disabled
                    value="{{ $productVariant->barcode }}" />

                <x-adminlte-input name="price" type="number" step="any" label="{{ __('Valor Venda') }}"
                    fgroup-class="col-lg-4" disabled value="{{ $productVariant->price / 100 }}" />
            </div>

            <div class="row">
                <x-adminlte-select name="product_size_id" label="{{ __('Tamanho') }}" fgroup-class="col-lg-6" disabled>
                    <option value="">{{ __('-') }}</option>
                    @foreach ($productSizes as $productSize)
                        <option value="{{ $productSize->id }}" @if ($productVariant->product_size_id == $productSize->id) selected @endif>
                            {{ $productSize->name }}</option>
                    @endforeach
                </x-adminlte-select>

                <x-adminlte-select name="active" label="{{ __('Ativo') }}" fgroup-class="col-lg-6" disabled>
                    <option value="">{{ __('-') }}</option>
                    <option value="1" @if ($productVariant->active == 1) selected @endif>{{ __('Ativo') }}
                    </option>
                    <option value="0" @if ($productVariant->active == 0) selected @endif>{{ __('Desativado') }}
                    </option>
                </x-adminlte-select>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('app.product-variants.edit', $productVariant) }}"
                    class="btn btn-primary mt-2">{{ __('Editar Variação') }}</a>
                <form id="delete-form" action="{{ route('app.product-variants.destroy', $productVariant) }}"
                    method="POST">
                    @csrf
                    @method('DELETE')
                    <button id="delete-button" type="submit" class="btn btn-danger">{{ __('Excluir Variação') }}</button>
                </form>
            </div>
        </div>
    </div>
@stop

@section('adminlte_js')
    <script>
        $(function() {
            $("#delete-button").click(function() {
                event.preventDefault();
                if (confirm("Deseja realmente excluir a variação?")) {
                    $('form#delete-form').submit();
                }
            });
        });
    </script>
@endsection
