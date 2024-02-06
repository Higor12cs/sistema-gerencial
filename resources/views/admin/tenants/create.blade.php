@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="d-flex justify-content-between mb-4">
                    <h4>{{ __('Creating Tenant') }}</h4>
                    <a href="{{ route('admin.tenants.index') }}" class="btn btn-dark">{{ __('Voltar') }}</a>
                </div>

                <div class="card bg-white">
                    <div class="card-header">{{ __('Novo Cliente') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form action="{{ route('admin.tenants.store') }}" method="POST">
                            @csrf

                            <div class="input-group mb-3">
                                <span class="input-group-text">{{ __('Código Cliente') }}</span>
                                <input name="id" type="text" class="form-control @error('id') is-invalid @enderror"
                                    placeholder="{{ __('Código Cliente') }}" value="{{ old('id') }}">
                                @error('id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="input-group mb-3">
                                <span class="input-group-text">{{ __('Nome Cliente') }}</span>
                                <input name="tenant_name" type="text"
                                    class="form-control @error('tenant_name') is-invalid @enderror"
                                    placeholder="{{ __('Nome Cliente') }}" value="{{ old('tenant_name') }}">
                                @error('tenant_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-dark">{{ __('Criar Cliente') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
