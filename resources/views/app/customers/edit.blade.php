@extends('adminlte::page')

@section('title', __('Editar Cliente'))

@section('content_header')
    <div class="d-flex justify-content-between">
        <x-header>{{ __('Editar Cliente') }} #{{ $customer->id }}</x-header>
        <a href="{{ route('app.customers.index') }}" class="btn btn-secondary mb-auto">{{ __('Voltar') }}</a>
    </div>
    <x-alerts />
@stop

@section('content')
    <div class="card">
        <div class="card-header">{{ __('Editar Cliente') }}</div>
        <div class="card-body">
            <form action="{{ route('app.customers.update', $customer) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <x-adminlte-input name="name" label="{{ __('Nome') }}" placeholder="{{ __('Nome') }}"
                        fgroup-class="col-lg-6" value="{{ $customer->name }}" enable-old-support />
                    <x-adminlte-input name="legal_name" label="{{ __('Razão Social') }}"
                        placeholder="{{ __('Razão Social') }}" fgroup-class="col-lg-6" value="{{ $customer->legal_name }}"
                        enable-old-support />
                </div>

                <div class="row">
                    <x-adminlte-input name="phone1" label="{{ __('Telefone 1') }}" placeholder="{{ __('Telefone') }}"
                        fgroup-class="col-lg-6" value="{{ $customer->phone1 }}" enable-old-support />
                    <x-adminlte-input name="phone2" label="{{ __('Telefone 2') }}" placeholder="{{ __('Telefone') }}"
                        fgroup-class="col-lg-6" value="{{ $customer->phone2 }}" enable-old-support />
                </div>

                <div class="row">
                    <x-adminlte-input name="date_of_birth" type="date" label="{{ __('Data Nascimento') }}"
                        placeholder="{{ __('Data Nascimento') }}" fgroup-class="col-lg-2"
                        value="{{ $customer->date_of_birth ? $customer->date_of_birth->format('Y-m-d') : null }}"
                        enable-old-support />
                    <x-adminlte-input name="cpf" label="{{ __('CPF') }}" placeholder="{{ __('CPF') }}"
                        fgroup-class="col-lg-5" value="{{ $customer->cpf }}" enable-old-support />
                    <x-adminlte-input name="rg" label="{{ __('RG') }}" placeholder="{{ __('RG') }}"
                        fgroup-class="col-lg-5" value="{{ $customer->rg }}" enable-old-support />
                </div>

                <div class="row">
                    <x-adminlte-input name="zip_code" label="{{ __('CEP') }}" placeholder="{{ __('CEP') }}"
                        fgroup-class="col-lg-3" value="{{ $customer->zip_code }}" enable-old-support />
                    <x-adminlte-input name="address" label="{{ __('Endereço') }}" placeholder="{{ __('Endereço') }}"
                        fgroup-class="col-lg-5" value="{{ $customer->address }}" enable-old-support />
                    <x-adminlte-input name="number" label="{{ __('Número') }}" placeholder="{{ __('Número') }}"
                        fgroup-class="col-lg-2" value="{{ $customer->number }}" enable-old-support />
                    <x-adminlte-input name="complement" label="{{ __('Complemento') }}"
                        placeholder="{{ __('Complemento') }}" fgroup-class="col-lg-2" value="{{ $customer->complement }}"
                        enable-old-support />
                </div>

                <div class="row">
                    <x-adminlte-input name="district" label="{{ __('Bairro') }}" placeholder="{{ __('Bairro') }}"
                        fgroup-class="col-lg-5" value="{{ $customer->district }}" enable-old-support />
                    <x-adminlte-input name="city" label="{{ __('Cidade') }}" placeholder="{{ __('Cidade') }}"
                        fgroup-class="col-lg-5" value="{{ $customer->city }}" enable-old-support />
                    <x-adminlte-input name="state" label="{{ __('Estado') }}" placeholder="{{ __('Estado') }}"
                        fgroup-class="col-lg-2" value="{{ $customer->state }}" enable-old-support />
                </div>

                <div class="row">
                    <x-adminlte-textarea name="observation" label="{{ __('Observação') }}"
                        placeholder="{{ __('Observação') }}" fgroup-class="col-lg-12" rows=3 enable-old-support>
                        {{ $customer->observation }}
                    </x-adminlte-textarea>
                </div>

                <div class="d-flex justify-content-left mt-2">
                    <button type="submit" class="btn btn-primary">{{ __('Salvar Cliente') }}</button>
                </div>
            </form>
        </div>
    </div>
@stop
