@extends('adminlte::page')

@section('title', __('Novo Cliente'))

@section('content_header')
    <div class="d-flex justify-content-between">
        <x-header>{{ __('Novo Cliente') }}</x-header>
        <a href="{{ route('app.customers.index') }}" class="btn btn-secondary mb-auto">{{ __('Voltar') }}</a>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-header">{{ __('Novo Cliente') }}</div>
        <div class="card-body">
            <form action="{{ route('app.customers.store') }}" method="POST">
                @csrf

                <div class="row">
                    <x-adminlte-input name="name" label="{{ __('Nome') }}" placeholder="{{ __('Nome') }}"
                        fgroup-class="col-lg-6" />
                    <x-adminlte-input name="legal_name" label="{{ __('Razão Social') }}"
                        placeholder="{{ __('Razão Social') }}" fgroup-class="col-lg-6" />
                </div>

                <div class="row">
                    <x-adminlte-input name="phone1" label="{{ __('Telefone 1') }}" placeholder="{{ __('Telefone') }}"
                        fgroup-class="col-lg-6" />
                    <x-adminlte-input name="phone2" label="{{ __('Telefone 2') }}" placeholder="{{ __('Telefone') }}"
                        fgroup-class="col-lg-6" />
                </div>

                <div class="row">
                    <x-adminlte-input name="date_of_birth" type="date" label="{{ __('Data Nascimento') }}"
                        placeholder="{{ __('Data Nascimento') }}" fgroup-class="col-lg-2" />
                    <x-adminlte-input name="cpf" label="{{ __('CPF') }}" placeholder="{{ __('CPF') }}"
                        fgroup-class="col-lg-5" />
                    <x-adminlte-input name="rg" label="{{ __('RG') }}" placeholder="{{ __('RG') }}"
                        fgroup-class="col-lg-5" />
                </div>

                <div class="row">
                    <x-adminlte-input name="zip_code" label="{{ __('CEP') }}" placeholder="{{ __('CEP') }}"
                        fgroup-class="col-lg-3" />
                    <x-adminlte-input name="address" label="{{ __('Endereço') }}" placeholder="{{ __('Endereço') }}"
                        fgroup-class="col-lg-5" />
                    <x-adminlte-input name="number" label="{{ __('Número') }}" placeholder="{{ __('Número') }}"
                        fgroup-class="col-lg-2" />
                    <x-adminlte-input name="complement" label="{{ __('Complemento') }}"
                        placeholder="{{ __('Complemento') }}" fgroup-class="col-lg-2" />
                </div>

                <div class="row">
                    <x-adminlte-input name="district" label="{{ __('Bairro') }}" placeholder="{{ __('Bairro') }}"
                        fgroup-class="col-lg-5" />
                    <x-adminlte-input name="city" label="{{ __('Cidade') }}" placeholder="{{ __('Cidade') }}"
                        fgroup-class="col-lg-5" />
                    <x-adminlte-input name="state" label="{{ __('Estado') }}" placeholder="{{ __('Estado') }}"
                        fgroup-class="col-lg-2" />
                </div>

                <div class="row">
                    <x-adminlte-textarea name="observation" label="{{ __('Observação') }}"
                        placeholder="{{ __('Observação') }}" fgroup-class="col-lg-12" rows=3 />
                </div>

                <div class="d-flex justify-content-left mt-2">
                    <button type="submit" class="btn btn-primary">{{ __('Incluir Cliente') }}</button>
                </div>
            </form>
        </div>
    </div>
@stop
