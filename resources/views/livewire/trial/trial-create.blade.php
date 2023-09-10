<div>
    <div class="form-group px-3 pt-2 pb-3 border">
        <label for="customer_id">Cliente</label>
        <select wire:model="customer_id" name="customer_id" class="form-control @error('customer_id') is-invalid @enderror">
            <option value="">-</option>
            @foreach ($customers as $customer)
                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
            @endforeach
        </select>
        @error('customer_id')
            <span class="error invalid-feedback"><strong>{{ $message }}</strong></span>
        @enderror
    </div>

    <div class="table-responsive mt-4">
        <table class="table table-bordered">
            <thead>
                <th class="col-1">#</th>
                <th class="col-7">Produto</th>
                <th class="col-1">Quantidade</th>
                <th class="col-1 text-nowrap">Valor Unit.</th>
                <th class="col-1 text-nowrap">Valor Total</th>
                <th class="col-1">Ações</th>
            </thead>
            <tbody>
                <tr>
                    <td colspan="2">
                        <select wire:model="product_variant_id" wire:change="updateSelectedProduct" name="product_variant_id" class="form-control form-control-sm">
                            <option value="">-</option>
                            @foreach ($products as $product)
                                <optgroup label="{{ $product->name }}">
                                    @foreach ($product->productVariants as $productVariant)
                                        <option value="{{ $productVariant->id }}">{{ $product->name }} -
                                            [{{ $productVariant->productSize->name }}]
                                        </option>
                                    @endforeach
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input wire:model="quantity" wire:change="updateSelectedProduct" type="number" step="any" name="quantity" class="form-control form-control-sm" autocomplete="off">
                    </td>
                    <td>
                        <input wire:model.blur="unit_price" type="text" name="unit_price" class="form-control form-control-sm" disabled>
                    </td>
                    <td>
                        <input wire:model.blur="total_price" type="text" name="total_price" class="form-control form-control-sm" disabled>
                    </td>
                    <td>
                        <button wire:click="addProduct" class="btn btn-primary btn-xs text-nowrap">Adicionar Produto</button>
                    </td>
                </tr>
                @foreach ($trialItems as $product)
                    <tr>
                        <td>{{ $product['index'] }}</td>
                        <td>{{ $product['name'] . ' - ' . str_pad($product['product_variant_id'], 4, 0, STR_PAD_LEFT) }}</td>
                        <td>{{ number_format($product['quantity'] / 100, 2, ',', '.') }}</td>
                        <td>{{ number_format($product['unit_price'] / 100, 2, ',', '.') }}</td>
                        <td>{{ number_format($product['total_price'] / 100, 2, ',', '.') }}</td>
                        <td>
                            <button wire:click="removeProduct({{ $product['index'] }})" class="btn btn-xs btn-danger">Remover</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-between mt-2">
        <button wire:click="finishTrial" class="btn btn-primary" @disabled($totalAmount == 0)>Finalizar Condicional</button>
        <h4 class="m-0">Total R${{ number_format($totalAmount / 100, 2, ',', '.') }}</h4>
    </div>
</div>
