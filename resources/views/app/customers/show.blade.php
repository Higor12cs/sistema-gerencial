@extends('adminlte::page')

@section('title', __('Visualizar Cliente'))

@section('content_header')
    <div class="d-flex justify-content-between">
        <x-header>{{ __('Visualizar Cliente') }}</x-header>
        <a href="{{ route('app.customers.index') }}" class="btn btn-secondary mb-auto">{{ __('Voltar') }}</a>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-header">{{ __('Visualizar Cliente') }}</div>
        <div class="card-body">
            <div class="row">
                <x-adminlte-input name="name" label="{{ __('Nome') }}" fgroup-class="col-lg-6"
                    value="{{ $customer->name }}" disabled />
                <x-adminlte-input name="legal_name" label="{{ __('Razão Social') }}" fgroup-class="col-lg-6"
                    value="{{ $customer->legal_name }}" disabled />
            </div>

            <div class="row">
                <x-adminlte-input name="phone1" label="{{ __('Telefone 1') }}" fgroup-class="col-lg-6"
                    value="{{ $customer->phone1 }}" disabled />
                <x-adminlte-input name="phone2" label="{{ __('Telefone 2') }}" fgroup-class="col-lg-6"
                    value="{{ $customer->phone2 }}" disabled />
            </div>

            <div class="row">
                <x-adminlte-input name="date_of_birth" type="date" label="{{ __('Data Nascimento') }}"
                    fgroup-class="col-lg-2"
                    value="{{ $customer->date_of_birth ? $customer->date_of_birth->format('Y-m-d') : null }}" disabled />
                <x-adminlte-input name="cpf" label="{{ __('CPF') }}" fgroup-class="col-lg-5"
                    value="{{ $customer->cpf }}" disabled />
                <x-adminlte-input name="rg" label="{{ __('RG') }}" fgroup-class="col-lg-5"
                    value="{{ $customer->rg }}" disabled />
            </div>

            <div class="row">
                <x-adminlte-input name="zip_code" label="{{ __('CEP') }}" fgroup-class="col-lg-3"
                    value="{{ $customer->zip_code }}" disabled />
                <x-adminlte-input name="address" label="{{ __('Endereço') }}" fgroup-class="col-lg-5"
                    value="{{ $customer->address }}" disabled />
                <x-adminlte-input name="number" label="{{ __('Número') }}" fgroup-class="col-lg-2"
                    value="{{ $customer->number }}" disabled />
                <x-adminlte-input name="complement" label="{{ __('Complemento') }}" fgroup-class="col-lg-2"
                    value="{{ $customer->complement }}" disabled />
            </div>

            <div class="row">
                <x-adminlte-input name="district" label="{{ __('Bairro') }}" fgroup-class="col-lg-5"
                    value="{{ $customer->district }}" disabled />
                <x-adminlte-input name="city" label="{{ __('Cidade') }}" fgroup-class="col-lg-5"
                    value="{{ $customer->city }}" disabled />
                <x-adminlte-input name="state" label="{{ __('Estado') }}" fgroup-class="col-lg-2"
                    value="{{ $customer->state }}" disabled />
            </div>

            <div class="row">
                <x-adminlte-textarea name="observation" label="{{ __('Observação') }}" fgroup-class="col-lg-12" rows=3
                    disabled>
                    {{ $customer->observation }}
                </x-adminlte-textarea>
            </div>

            <div class="d-flex justify-content-between mt-2">
                <a href="{{ route('app.customers.edit', $customer) }}"
                    class="btn btn-primary mb-auto">{{ __('Editar Cliente') }}</a>

                <form action="{{ route('app.customers.destroy', $customer) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger"
                        onclick="return confirm('{{ __('Tem certeza que deseja excluir este cliente? Todos seus dados serão definidos como vazios, respeitando a LGPD, e ele será desativado. Esta ação não poderá ser desfeita.') }}')">{{ __('Excluir Cliente') }}</button>
                </form>
            </div>
        </div>
    </div>
@stop
