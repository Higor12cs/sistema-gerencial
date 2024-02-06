@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="d-flex justify-content-between mb-4">
                    <h4>{{ __('Clientes') }}</h4>
                    <a href="{{ route('admin.tenants.create') }}" class="btn btn-dark">{{ __('Novo Cliente') }}</a>
                </div>

                <div class="card bg-white">
                    <div class="card-header">{{ __('Clientes') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <th class="col-9 text-nowrap">{{ __('Cliente') }}</th>
                                    <th class="col-2 text-nowrap">{{ __('Data Vencimento') }}</th>
                                    <th class="col-1 text-nowrap">{{ __('Ações') }}</th>
                                </thead>
                                <tbody>
                                    @forelse ($tenants as $tenant)
                                        <tr class="@if ($tenant->expiration_date < now()) table-danger @endif">
                                            <td>{{ $tenant->tenant_name . ' - ' . $tenant->tenant_code }}</td>
                                            <td>{{ $tenant->expiration_date->format('d/m/Y') }}</td>
                                            <td class="text-nowrap">
                                                <a href="{{ route('admin.tenants.show', $tenant) }}"
                                                    class="btn btn-sm btn-dark">{{ __('Detalhes') }}</a>
                                                <a href="{{ route('admin.tenants.edit', $tenant) }}"
                                                    class="btn btn-sm btn-dark">{{ __('Editar') }}</a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3">{{ __('Nenhum cliente cadastrado.') }}</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
