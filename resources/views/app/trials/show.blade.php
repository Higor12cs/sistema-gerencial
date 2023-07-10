@extends('adminlte::page')

@section('title', 'Condicional')

@section('content_header')
    <div class="d-flex justify-content-between">
        <x-header>Condicional #{{ $trial->id }}</x-header>
        <a href="{{ route('app.trials.index') }}" class="btn btn-secondary">Voltar</a>
    </div>
    <x-alerts />
@stop

@section('content')
    <div class="card">
        <div class="card-header">Cliente</div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-8">
                    <label for="customerId">{{ __('Cliente') }}</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" value="{{ $trial->customer->name }}" disabled>
                    </div>
                </div>
                <div class="col-lg-2">
                    <label for="customerId">{{ __('Data Emissão') }}</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control"
                            value="{{ $trial->date ? $trial->date->format('d/m/Y h:i') : '' }}" disabled>
                    </div>
                </div>
                <div class="col-lg-2">
                    <label for="customerId">{{ __('Data Retorno') }}</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control"
                            value="{{ $trial->return_date ? $trial->return_date->format('d/m/Y h:i') : '' }}" disabled>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <label for="customerId">{{ __('Endereço') }}</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" value="{{ $trial->customer->address }}" disabled>
                    </div>
                </div>
                <div class="col-md-2">
                    <label for="customerId">{{ __('Número') }}</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" value="{{ $trial->customer->number }}" disabled>
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="customerId">{{ __('Complemento') }}</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" value="{{ $trial->customer->complement }}" disabled>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">Produtos</div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <th class="col-6 text-nowrap">Produto</th>
                        <th class="col-2 text-nowrap">Quantidade</th>
                        <th class="col-2 text-nowrap">Preço Unitário</th>
                        <th class="col-2 text-nowrap">Preço Total</th>
                    </thead>
                    <tbody>
                        @forelse ($trialItems as $trialItem)
                            <tr>
                                <td>{{ $trialItem->productVariant->product->name }}
                                    [{{ $trialItem->productVariant->productSize->name }}] -
                                    {{ $trialItem->productVariant->id }}
                                </td>
                                <td>{{ number_format($trialItem->quantity / 100, 2, ',', '.') }}</td>
                                <td>{{ number_format($trialItem->unit_price / 100, 2, ',', '.') }}</td>
                                <td>{{ number_format($trialItem->total_price / 100, 2, ',', '.') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">Nenhum item adicionado ao condicional.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <hr>
            <div class="d-flex justify-content-between">
                <a href="{{ route('app.trials.edit', $trial) }}" class="btn btn-primary">Editar Condicional</a>
                <form action="{{ route('app.trials.destroy', $trial) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger"
                        onclick="return confirm('{{ __('Tem certeza que deseja excluir este condicional?') }}')">Excluir
                        Condicional</button>
                </form>
            </div>
        </div>
    </div>
@stop
