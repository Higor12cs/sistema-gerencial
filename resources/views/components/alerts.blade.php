<div>
    @if (session('success'))
        <x-adminlte-alert title="{{ __('Sucesso') }}" id="bootstrap-alert" theme="success" class="mt-4" dismissable>
            {{ session('success') }}
        </x-adminlte-alert>
    @elseif (session('warning'))
        <x-adminlte-alert title="{{ __('Aviso') }}" theme="warning" class="mt-4" dismissable>
            {{ session('warning') }}
        </x-adminlte-alert>
    @elseif (session('danger'))
        <x-adminlte-alert title="{{ __('Erro') }}" theme="danger" class="mt-4" dismissable>
            {{ session('danger') }}
        </x-adminlte-alert>
    @endif
</div>
