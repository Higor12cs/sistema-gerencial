@extends('adminlte::page')

@section('title', 'Condicional')

@section('content_header')
    <div class="d-flex justify-content-between">
        <x-header>Visualizar Condicional</x-header>
        <a href="{{ route('app.trials.index') }}" class="btn btn-secondary">Voltar</a>
    </div>
    <x-alerts />
@stop

@section('content')
    <div class="card">
        <div class="card-header">Condicional #{{ str_pad($trial->id, 4, 0, STR_PAD_LEFT) }}</div>
        <div class="card-body">
            <div class="px-3 py-2 border">
                <x-adminlte-input name="customer" label="Cliente" value="{{ $trial->customer->name }}" disabled />
            </div>

            <div class="table-responsive mt-4">
                <table class="table table-bordered table-hover">
                    <thead>
                        <th class="col-1">#</th>
                        <th class="col-8">Produto</th>
                        <th class="col-1">Quantidade</th>
                        <th class="col-1 text-nowrap">Valor Unit.</th>
                        <th class="col-1 text-nowrap">Valor Total</th>
                    </thead>
                    <tbody>
                        @foreach ($trialItems as $trialItem)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $trialItem->product->name . ' - ' . str_pad($trialItem->product_variant_id, 4, 0, STR_PAD_LEFT) }}
                                </td>
                                <td>{{ number_format($trialItem->quantity / 100, 2, ',', '.') }}</td>
                                <td>{{ number_format($trialItem->unit_price / 100, 2, ',', '.') }}</td>
                                <td>{{ number_format($trialItem->total_price / 100, 2, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-end mt-2">
                <h4 class="m-0">Total R${{ number_format($trial->total_price / 100, 2, ',', '.') }}</h4>
            </div>
        </div>
    </div>
@stop
