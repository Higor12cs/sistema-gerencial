<div>
    <form wire:submit="save">
        @csrf

        <div class="row">
            <x-adminlte-input wire:model="name" name="name" label="{{ __('Nome') }}" placeholder="{{ __('Nome') }}"
                fgroup-class="col-12" enable-old-support autocomplete="off" />
        </div>

        <div class="row">
            <x-adminlte-select wire:model="product_brand_id" name="product_brand_id" label="{{ __('Marca') }}"
                fgroup-class="col-lg-4" enable-old-support>
                <option value="">{{ __('-- selecione --') }}</option>
                @foreach ($productBrands as $productBrand)
                    <option value="{{ $productBrand->id }}">{{ $productBrand->name }}</option>
                @endforeach
            </x-adminlte-select>

            <x-adminlte-select wire:model="product_category_id" name="product_category_id" label="{{ __('Categoria') }}"
                fgroup-class="col-lg-4" enable-old-support>
                <option value="">{{ __('-- selecione --') }}</option>
                @foreach ($productCategories as $productCategory)
                    <option value="{{ $productCategory->id }}">{{ $productCategory->name }}</option>
                @endforeach
            </x-adminlte-select>

            <x-adminlte-select wire:model="product_season_id" name="product_season_id" label="{{ __('Temporada') }}"
                fgroup-class="col-lg-4" enable-old-support>
                <option value="">{{ __('-- selecione --') }}</option>
                @foreach ($productSeasons as $productSeason)
                    <option value="{{ $productSeason->id }}">{{ $productSeason->name }}</option>
                @endforeach
            </x-adminlte-select>
        </div>

        <div class="table-responsive mt-2">
            <table class="table table-bordered table-striped">
                <thead>
                    <th colspan="6">Variações</th>
                </thead>
                <thead>
                    <th class="col-3 text-nowrap">{{ __('SKU') }}</th>
                    <th class="col-3 text-nowrap">{{ __('Código Barras') }}</th>
                    <th class="col-3 text-nowrap">{{ __('Tamanho') }}</th>
                    <th class="col-1 text-nowrap">{{ __('Valor Custo') }}</th>
                    <th class="col-1 text-nowrap">{{ __('Valor Venda') }}</th>
                    <th class="col-1 text-nowrap">{{ __('Ações') }}</th>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="form-group">
                                <input wire:model="sku" type="text"
                                    class="form-control form-control-sm @error('sku') is-invalid @enderror" autocomplete="off">
                                @error('sku')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <input wire:model="barcode" type="text"
                                    class="form-control form-control-sm @error('barcode') is-invalid @enderror" autocomplete="off">
                                @error('barcode')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </td>
                        <td>
                            <select wire:model.live="product_size_id" name="product_size_id"
                                class="form-control form-control-sm">
                                <option value="">{{ __('-- selecione --') }}</option>
                                @foreach ($productSizes as $productSize)
                                    <option value="{{ $productSize->id }}">{{ $productSize->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <div class="form-group">
                                <input wire:model="cost" type="text"
                                    class="form-control form-control-sm @error('cost') is-invalid @enderror" autocomplete="off">
                                @error('cost')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <input wire:model="price" type="text"
                                    class="form-control form-control-sm @error('price') is-invalid @enderror" autocomplete="off">
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </td>
                        <td>
                            <button type="button" wire:click="addProductVariant"
                                class="btn btn-xs btn-primary text-nowrap"
                                wire:loading.attr="disabled">{{ __('Adicionar Variação') }}</button>
                        </td>
                    </tr>
                    @foreach ($productVariants as $productVariant)
                        <tr>
                            <td>{{ $productVariant['sku'] }}</td>
                            <td>{{ $productVariant['barcode'] }}</td>
                            <td>{{ $productVariant['product_size_id'] }}</td>
                            <td>{{ number_format($productVariant['cost'] / 100, 2, ',', '.') }}</td>
                            <td>{{ number_format($productVariant['price'] / 100, 2, ',', '.') }}</td>
                            <td>
                                <button type="button"
                                    wire:click="removeProductVariant({{ $productVariant['index'] }})"
                                    class="btn btn-xs btn-danger" wire:loading.attr="disabled">Remover</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <button type="submit" class="btn btn-primary mt-2">{{ __('Salvar Produto') }}</button>
    </form>
</div>
