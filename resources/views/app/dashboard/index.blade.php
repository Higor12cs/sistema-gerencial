@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <x-header>{{ __('Dashboard') }}</x-header>
    <x-alerts />
@stop

@section('content')
    <div class="alert alert-success alert-dismissible fade show" id="success-alert" role="alert">
        <span class="alert-heading">Bem-vindo!</span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@stop
