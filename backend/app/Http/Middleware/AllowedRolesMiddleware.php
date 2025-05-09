<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AllowedRolesMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
      
        $user = $request->user();
        if ($user->role == 0) {
          return $next($request);
        }
        if (!in_array($user->role, $roles)) {
            return response()->json(['message' => 'Unauthorized! You do not have the required permissions.'], 403);
        }   
        return $next($request);
    }
}
