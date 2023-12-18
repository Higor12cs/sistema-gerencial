@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <x-header>{{ __('Dashboard') }}</x-header>
    <x-alerts />
@stop

@php
    function formatarNumero($numero)
    {
        if ($numero <= 999) {
            return $numero;
        } elseif ($numero <= 9999) {
            return number_format($numero / 1000, 2, ',', '') . ' K';
        } elseif ($numero <= 99999) {
            return number_format($numero / 1000, 1, ',', '') . ' K';
        } elseif ($numero <= 999999) {
            return number_format($numero / 1000, 0, ',', '') . ' K';
        } else {
            return number_format($numero / 1000000, 2, ',', '') . ' M';
        }
    }
@endphp

@section('content')
    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ formatarNumero($orderValueSum / 100) }}</h3>
                    <p>{{ __('Faturamento') }}</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="{{ route('app.orders.index') }}" class="small-box-footer">Mais <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ number_format($trialCount, 0, ',', '.') }}</h3>
                    <p>{{ __('Condicionais') }}</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="{{ route('app.trials.index') }}" class="small-box-footer">Mais <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ number_format($customersCount, 0, ',', '.') }}</h3>
                    <p>{{ __('Clientes Cadastrados') }}</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="{{ route('app.customers.index') }}" class="small-box-footer">Mais <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ number_format($itemsOrderedSum / 100, 0, ',', '.') }}</h3>
                    <p>{{ __('Produtos Vendidos') }}</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="{{ route('app.orders.index') }}" class="small-box-footer">Mais <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
@stop
