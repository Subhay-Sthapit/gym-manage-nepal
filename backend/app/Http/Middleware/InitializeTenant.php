<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class InitializeTenant
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        // No authenticated user
        if (!$user) {
            return response()->json([
                'message' => 'Unauthenticated.'
            ], 401);
        }

        // Authenticated user but does belong to a gym.
        if (!$user->gym_id){
            return response()->json([
                'message' => 'No Gym context found for this account.'
            ], 403);
        }

        // Bind the current gym_id into the service container
        // This is read by the TenantScope
        app()->instance('current_gym_id', $user->gym_id);

        return $next($request);
    }
}
