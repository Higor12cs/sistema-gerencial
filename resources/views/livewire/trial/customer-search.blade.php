<div class="row">
    <div class="col-12">
        <div class="form-group">
            <label for="customerId">{{ __('Cliente') }}</label>
            <select wire:model="customerId" class="form-control" name="customerId" @disabled($selected) autofocus>
                <option value="">{{ __('-- selecione --') }}</option>
                @foreach ($customers as $customer)
                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="d-flex justify-content-between">
            @if (!$selected)
                <button wire:click="selectCustomer" class="btn btn-primary">{{ __('Selecionar') }}</button>
            @else
                <button class="btn btn-secondary" disabled>{{ __('Editar') }}</button>
            @endif
            <button wire:click="discardTrial" class="btn btn-danger">Abandonar Condicional</button>
        </div>
    </div>
</div>
