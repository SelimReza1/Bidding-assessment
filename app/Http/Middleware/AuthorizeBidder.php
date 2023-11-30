<?php

namespace App\Http\Middleware;

use App\Models\Bidder;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthorizeBidder
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (
            session()->has('bidder') &&
            isset(session()->get('bidder')['token']) &&
            Bidder::where(
                'auth_token',
                session()->get('bidder')['token']
            )
            ->count() === 1
        ) {
            return $next($request);
        }
        return redirect()->route('user.bidding_session.index');
    }
}
