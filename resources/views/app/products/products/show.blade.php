@extends('adminlte::page')

@section('title', __('Visualizar Produto'))

@section('content_header')
    <div class="d-flex justify-content-between">
        <x-header>{{ __('Produto') }} #{{ $product->id }}</x-header>
        <a href="{{ route('app.products.index') }}" class="btn btn-secondary mb-auto">{{ __('Voltar') }}</a>
    </div>
    <x-alerts />
@stop

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
                <x-adminlte-select name="product_brand_id" label="{{ __('Marca') }}" fgroup-class="col-md-6" disabled>
                    <option value="">{{ __('-') }}</option>
                    @foreach ($productBrands as $productBrand)
                        <option value="{{ $productBrand->id }}" @if ($productBrand->id === $product->product_brand_id) selected @endif>
                            {{ $productBrand->name }}</option>
                    @endforeach
                </x-adminlte-select>

                <x-adminlte-select name="product_category_id" label="{{ __('Categoria') }}" fgroup-class="col-md-6"
                    disabled>
                    <option value="">{{ __('-') }}</option>
                    @foreach ($productCategories as $productCategory)
                        <option value="{{ $productCategory->id }}" @if ($productCategory->id === $product->product_category_id) selected @endif>
                            {{ $productCategory->name }}</option>
                    @endforeach
                </x-adminlte-select>
            </div>

            <div class="row">
                <x-adminlte-select name="product_season_id" label="{{ __('Temporada') }}" fgroup-class="col-md-6" disabled>
                    <option value="">{{ __('-') }}</option>
                    @foreach ($productSeasons as $productSeason)
                        <option value="{{ $productSeason->id }}" @if ($productSeason->id === $product->product_season_id) selected @endif>
                            {{ $productSeason->name }}</option>
                    @endforeach
                </x-adminlte-select>

                <x-adminlte-select name="product_season_id" label="{{ __('Tamanho') }}" fgroup-class="col-md-6" disabled>
                    <option value="">{{ __('-') }}</option>
                    @foreach ($productSizes as $productSize)
                        <option value="{{ $productSize->id }}" @if ($productSize->id === $product->product_size_id) selected @endif>
                            {{ $productSize->name }}</option>
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
                <form id="delete-form" action="{{ route('app.products.destroy', $product) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button id="delete-button" type="submit" class="btn btn-danger">{{ __('Excluir Produto') }}</button>
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
                if (confirm("Deseja realmente excluir este produto?")) {
                    $('form#delete-form').submit();
                }
            });
        });
    </script>
@endsection
