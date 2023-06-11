<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\CustomerStoreRequest;
use App\Http\Requests\Customer\CustomerUpdateRequest;
use App\Models\Customer;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $customers = Customer::all();

        return view('app.customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('app.customers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CustomerStoreRequest $request): RedirectResponse
    {
        Customer::create($request->validated());

        return to_route('app.customers.index')->with('success', __('Cliente criado com sucesso!'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer): View
    {
        return view('app.customers.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer): View
    {
        return view('app.customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CustomerUpdateRequest $request, Customer $customer): RedirectResponse
    {
        $customer->update($request->validated());

        return to_route('app.customers.index')->with('success', __('Cliente atualizado com sucesso!'));
    }

    /**
     * Remove the specified resource from storage.
     */
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
        $customer->delete();

        return to_route('app.customers.index')->with('success', __('Cliente excluído com sucesso!'));
    }
}
