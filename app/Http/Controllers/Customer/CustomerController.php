<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\CustomerRequest;
use App\Models\Customer;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CustomerController extends Controller
{
    public function index(): View
    {
        $customers = Customer::all();

        return view('app.customers.index', compact('customers'));
    }

    public function create(): View
    {
        return view('app.customers.create');
    }

    public function store(CustomerRequest $request): RedirectResponse
    {
        Customer::create($request->validated());

        return to_route('app.customers.index')->with('success', __('Cliente criado com sucesso!'));
    }

    public function show(Customer $customer): View
    {
        return view('app.customers.show', compact('customer'));
    }

    public function edit(Customer $customer): View
    {
        return view('app.customers.edit', compact('customer'));
    }

    public function update(CustomerRequest $request, Customer $customer): RedirectResponse
    {
        $customer->update($request->validated());

        return to_route('app.customers.index')->with('success', __('Cliente atualizado com sucesso!'));
    }

    public function destroy(Customer $customer): RedirectResponse
    {
        $customer->name = __('Cliente Excluído');
        $customer->legal_name = __('Cliente Excluído');
        $customer->date_of_birth = null;
        $customer->cpf = '***';
        $customer->rg = '***';
        $customer->email = '***';
        $customer->phone1 = '***';
        $customer->phone2 = '***';
        $customer->zip_code = '***';
        $customer->address = '***';
        $customer->number = '***';
        $customer->complement = '***';
        $customer->district = '***';
        $customer->city = '***';
        $customer->state = '***';
        $customer->active = false;
        $customer->observation = '***';

        $customer->save();
        // $customer->delete();

        return to_route('app.customers.index')->with('success', __('Cliente excluído com sucesso!'));
    }
}
