<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StudioAccess
{
    public function handle(Request $request, Closure $next): Response
    {
        $expectedUser = (string) config('cafe.studio_user');
        $expectedPassword = (string) config('cafe.studio_password');
        $providedUser = (string) $request->getUser();
        $providedPassword = (string) $request->getPassword();

        $valid = $expectedPassword !== ''
            && hash_equals($expectedUser, $providedUser)
            && hash_equals($expectedPassword, $providedPassword);

        if (! $valid) {
            return response('Нужен доступ сотрудника кофейни.', 401, [
                'WWW-Authenticate' => 'Basic realm="KOFI Studio", charset="UTF-8"',
            ]);
        }

        return $next($request);
    }
}
