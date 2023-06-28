<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsBvnVerfied
{
    /**
     * @param Request $request
     * @param Closure $next
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {

        if(!auth()->user()->bvn_isVerified()) {
            return redirect('/bvn/initiate');
        }

        return $next($request);
    }

}
