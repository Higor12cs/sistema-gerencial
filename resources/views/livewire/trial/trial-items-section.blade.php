@section('plugins.Select2', true)

<div>
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label for="productVariantId">Produtos</label>
                <select wire:model="productVariantId" class="form-control" name="productVariantId"
                    @disabled(!$inputEnabled) autofocus>
                    <option value="">-- selecione --</option>
                    @foreach ($products as $product)
                        <optgroup label="{{ $product->name }}">
                            @foreach ($product->productVariants as $productVariant)
                                <option value="{{ $productVariant->id }}">{{ $product->name }} -
                                    [{{ $productVariant->productSize->name }}]
                                </option>
                            @endforeach
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <button wire:click="selectProduct" class="btn btn-primary mb-3" @disabled(!$inputEnabled)>Selecionar
        Produto</button>

    @livewire('trial.trial-items-table', ['trialId' => $trialId])
</div>

@push('js')
    <script>
        $(document).ready(function() {
            $('.product-variant-input').select2({
                theme: 'bootstrap4',
                width: 'resolve',
                placeholder: '-- selecione --',
                allowClear: true
            });
        });

        $(document).on('select2:open', () => {
            document.querySelector('.select2-search__field').focus();
        });
    </script>
@endpush
