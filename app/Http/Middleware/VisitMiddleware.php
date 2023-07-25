<?php

namespace App\Http\Middleware;

use App\Models\Visit;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class VisitMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(Request): (Response|RedirectResponse) $next
     *
     * @return RedirectResponse|Response
     */
    public function handle(Request $request, Closure $next)
    {
        // I just want to know if anyone has looked at my page or not.
        Visit::create([
            'ip_address' => $request->getClientIp(),
            'user_agent' => $request->userAgent(),
        ]);

        return $next($request);
    }
}
