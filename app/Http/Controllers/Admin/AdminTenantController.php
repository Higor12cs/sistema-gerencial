<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CentralUser;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminTenantController extends Controller
{
    public function index(): View
    {
        $tenants = Tenant::all();

        return view('admin.tenants.index', compact('tenants'));
    }

    public function create(): View
    {
        return view('admin.tenants.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'id' => ['required', 'max:50', 'unique:tenants,id'],
            'tenant_name' => ['required', 'max:255'],
        ]);

        $tenant = Tenant::create([
            'id' => $request->id,
            'tenant_name' => $request->tenant_name,
            'tenant_code' => $this->generateTenantCode(),
        ]);

        $user = CentralUser::create([
            'name' => 'Admin',
            'username' => 'admin',
            'password' => bcrypt('admin'),
            'tenant_code' => $tenant->tenant_code,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        tenancy()->initialize($tenant);

        User::create([
            'global_id' => $user->global_id,
            'name' => 'Admin',
            'username' => 'admin',
            'password' => bcrypt('admin'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return to_route('admin.tenants.index')->with('status', 'Tenant criado com sucesso!');
    }

    public function show(Tenant $tenant): View
    {
        return view('admin.tenants.show', compact('tenant'));
    }

    public function edit(Tenant $tenant): View
    {
        return view('admin.tenants.edit', compact('tenant'));
    }

    public function update(Request $request, Tenant $tenant): RedirectResponse
    {
        $request->validate([
            'tenant_name' => ['required', 'max:255'],
            'expiration_date' => ['required', 'date'],
        ]);

        $tenant->update([
            'tenant_name' => $request->tenant_name,
            'expiration_date' => $request->expiration_date,
        ]);

        return to_route('admin.tenants.index')->with('status', 'Tenant atualizado com sucesso!');
    }

    private function generateTenantCode(): string
    {
        $lastTenant = Tenant::latest()->first();

        if (! $lastTenant) {
            return 1000;
        }

        return intval($lastTenant->tenant_code) + 5;
    }
}
