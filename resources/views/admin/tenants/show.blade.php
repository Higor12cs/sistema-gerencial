@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="d-flex justify-content-between mb-4">
                    <h4>{{ __('Detalhes Cliente') }}</h4>
                    <a href="{{ route('admin.tenants.index') }}" class="btn btn-dark">{{ __('Voltar') }}</a>
                </div>

                <div class="card bg-white">
                    <div class="card-header">{{ __('Detalhes Cliente') }}</div>

                    <div class="card-body">
                        <div class="input-group mb-3">
                            <span class="input-group-text">{{ __('Código Cliente') }}</span>
                            <input name="id" type="text" class="form-control" value="{{ $tenant->id }}" disabled>
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text">{{ __('Nome Cliente') }}</span>
                            <input name="tenant_name" type="text" class="form-control" value="{{ $tenant->tenant_name }}"
                                disabled>
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text">{{ __('Data Vencimento') }}</span>
                            <input name="expiration_date" type="date" class="form-control"
                                value="{{ $tenant->expiration_date->format('Y-m-d') }}" disabled>
                        </div>

                        <a href="{{ route('admin.tenants.edit', $tenant) }}"
                            class="btn btn-dark">{{ __('Editar Cliente') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
