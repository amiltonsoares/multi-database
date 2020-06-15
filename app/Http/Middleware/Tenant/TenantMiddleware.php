<?php

namespace App\Http\Middleware\Tenant;

use App\Models\Tenant;
use App\Tenants\TenantManager;
use Closure;

class TenantMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $tenantManager = app(TenantManager::class);
        if ($tenantManager->isMainDomain())
            return $next($request);

        $tenant = $this->getTenant($request->getHost());

        if (!$tenant && $request->url() != route('404.tenant')) {
            return redirect()->route('404.tenant');
        } else if ($request->url() != route('404.tenant') && !$tenantManager->isMainDomain()) {
            $tenantManager->setConnection($tenant);

            $this->setSessionTenant($tenant->only([
                'name', 'uuid',
            ]));
        }

        return $next($request);
    }

    public function getTenant($host)
    {
        return Tenant::where('domain', $host)->first();
    }

    public function setSessionTenant($tenant)
    {
        session()->put('tenant', $tenant);
    }
}
