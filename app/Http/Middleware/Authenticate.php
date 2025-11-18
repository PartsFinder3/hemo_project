<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
protected function redirectTo($request)
{
    if ($request->expectsJson()) {
        return null;
    }

    // Get the current path
    $path = $request->path();

    // Check if the path contains guard-specific segments
    if (str_contains($path, 'admin')) {
        return route('admin.login');
    } elseif (str_contains($path, 'supplier')) {
        return route('supplier.login');
    }

    // Default fallback
    return '/';
}
}
