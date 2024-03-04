<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PageReloadCounterMiddleware
{
    public function handle($request, Closure $next)
    {
        $pageReloadCount = session('page_reload_count', 0);

        if (auth()->check()) {
            $pageReloadCount++;
            session(['page_reload_count' => $pageReloadCount]);
        }

        return $next($request);
    }
}
