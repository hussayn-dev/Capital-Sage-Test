<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsBvnVerfied
{
    public function handle(Request $request, Closure $next): Response
    {

        if (! auth()->user()->bvn_isVerified()) {
            return redirect('/bvn/initiate');
        }

        return $next($request);
    }
}
