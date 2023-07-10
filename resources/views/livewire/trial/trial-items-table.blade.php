<div class="table-responsive">
    <table class="table">
        <thead>
            <th class="col-5">Produto</th>
            <th class="col-2">Quantidade</th>
            <th class="col-2">Preço Unitário</th>
            <th class="col-2">Preço Total</th>
            <th class="col-1">Ações</th>
        </thead>
        <tbody>
            @forelse ($trialItems as $trialItem)
                <tr>
                    <td>{{ $trialItem->productVariant->product->name }}
                        [{{ $trialItem->productVariant->productSize->name }}] -
                        {{ $trialItem->productVariant->id }}</td>
                    <td>{{ number_format($trialItem->quantity / 100, 2, ',', '.') }}</td>
                    <td>{{ number_format($trialItem->unit_price / 100, 2, ',', '.') }}</td>
                    <td>{{ number_format($trialItem->total_price / 100, 2, ',', '.') }}</td>
                    <td></td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Nenhum item adicionado ao condicional.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
