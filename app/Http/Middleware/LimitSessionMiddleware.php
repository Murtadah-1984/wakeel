<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class LimitSessionMiddleware
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        if ($user) {
            $maxSessions = 4; // Set this to the number of allowed sessions per user or tenant

            $activeSessions = DB::table('sessions')
                ->where('user_id', $user->id)
                ->count();

            if ($activeSessions >= $maxSessions) {
                // Option 1: Invalidate all other sessions
                DB::table('sessions')
                    ->where('user_id', $user->id)
                    ->where('id', '!=', Session::getId())
                    ->delete();

                // Option 2: Log the user out
                Auth::logout();
                return redirect('/login')->withErrors([
                    'email' => 'You have been logged out because another session was started.',
                ]);
            }
        }

        return $next($request);
    }
}
