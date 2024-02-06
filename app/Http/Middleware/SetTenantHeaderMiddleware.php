<?php

namespace App\Http\Middleware;

use App\Models\Tenant;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetTenantHeaderMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! auth()->user()->tenant_code) {
            abort(403);
        }

        $tenant = Tenant::where('tenant_code', auth()->user()->tenant_code)->first();

        $request->headers->set('X-Tenant', $tenant->id);

        return $next($request);
    }
}
