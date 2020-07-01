<?php

namespace App\Http\Middleware\Tenant;

use Closure;

class TenantMainDomain
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
        if (request()->getHost() != config('tenant.main_domain')) {
            abort(401, 'Não Autorizado!');
        }

        return $next($request);
    }
}
