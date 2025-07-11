<?php

namespace App\Http\Middleware;

use App\Enums\UserRole;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleOrAboveMiddleware
{
    protected array $roleHierarchy = [
        UserRole::USER->value => 1,
        UserRole::MANAGER->value => 2,
        UserRole::ADMIN->value => 3,
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $requiredRole): Response
    {
        $user = $request->user();

        if (! $user) {
            abort(401, 'Unauthenticated');
        }

        $userRole = $user->getRoleNames()->first();

        if (! isset($this->roleHierarchy[$userRole]) || ! isset($this->roleHierarchy[$requiredRole])) {
            abort(403, 'Invalid role definition');
        }

        if ($this->roleHierarchy[$userRole] < $this->roleHierarchy[$requiredRole]) {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}
