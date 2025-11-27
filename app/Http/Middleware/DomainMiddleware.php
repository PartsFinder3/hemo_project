<?php

// namespace App\Http\Middleware;

// use Closure;
// use App\Models\Domain;

// class DomainMiddleware
// {
//     public function handle($request, Closure $next)
//     {
//         $host = $request->getHost();

//         $domain = Domain::where('domain_url', $host)->with('cities','blogs','companyData','metaTags','partsMeta')->first()
//             ?? Domain::where('domain_url', 'default')->with('cities','blogs','companyData','metaTags','partsMeta')->first();

//         view()->share('domain', $domain);

//         return $next($request);
//     }
// }

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Log;
use Closure;
use App\Models\Domain;

class DomainMiddleware
{
    public function handle($request, Closure $next)
    {
        // Try all possible ways to detect the real domain
        $host =
            $_SERVER['HTTP_HOST']
            ?? $request->getHost()
            ?? $_SERVER['SERVER_NAME']
            ?? parse_url($request->headers->get('referer'), PHP_URL_HOST)
            ?? 'partsfinder.ae';

        $host = str_replace('www.', '', strtolower($host));

        $domain = Domain::where('domain_url', $host)
            ->with('cities', 'blogs', 'companyData', 'metaTags', 'partsMeta')
            ->first()
            ?? Domain::where('domain_url', 'default')
                ->with('cities', 'blogs', 'companyData', 'metaTags', 'partsMeta')
                ->first();

        // Debug (temporary)
        Log::info('Detected Domain Host: ' . $host);

        view()->share('domain', $domain);

        return $next($request);
    }
}

